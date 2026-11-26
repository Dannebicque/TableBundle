# Passer de TableBundle 1.x à 2.0

## Prérequis

- Symfony **7.4** ou **8.x**
- PHP **8.2** minimum (8.4 pour Symfony 8)
- AssetMapper ou Webpack Encore, avec StimulusBundle

## En 5 étapes

### 1. Mettre à jour

```bash
composer require "dannebicque/table-bundle:^2.0" -W
```

### 2. Activer le JavaScript

Retirer l'ancien script s'il est présent dans vos templates :

```twig
<script src="{{ asset('bundles/dannebicquetable/table.js') }}" defer></script>
```

Dans `assets/controllers.json`, sous `controllers` :

```json
"@dannebicque/table-bundle": {
    "table": { "enabled": true, "fetch": "eager" },
    "modal": { "enabled": true, "fetch": "eager" }
}
```

### 3. Remplacer les paramètres d'icônes

Supprimer les paramètres `iconDelete`, `iconEdit`, `iconShow`, `iconDuplicate`, et créer `config/packages/da_table.yaml` (facultatif si les icônes par défaut vous conviennent) :

```yaml
da_table:
    icons:
        delete: 'fas fa-trash'
        edit: 'fas fa-edit'
        show: 'fas fa-eye'
        duplicate: 'fas fa-copy'
```

### 4. Vérifier les colonnes qui produisent du HTML

Les valeurs sont maintenant **échappées par défaut**. Si des balises apparaissent en clair dans un tableau, c'est ici.

```php
// Avant : le HTML passait tel quel
->addColumn('name', PropertyColumnType::class, [
    'render' => fn (User $u) => '<strong>'.$u->getName().'</strong>',
])

// Après : le déclarer, et échapper vous-même les données
->addColumn('name', PropertyColumnType::class, [
    'render' => fn (User $u) => '<strong>'.htmlspecialchars($u->getName()).'</strong>',
    'is_safe_html' => true,
])
```

Même chose pour vos classes de colonnes :

```php
public function configureOptions(OptionsResolver $resolver): void
{
    parent::configureOptions($resolver);
    $resolver->setDefault('is_safe_html', true);
}
```

### 5. Adapter les routes de suppression

`RowDeleteLinkType` demande confirmation puis envoie une requête **`DELETE`** en arrière-plan.

```php
#[Route('/users/{id}', name: 'user_delete', methods: ['DELETE'])]
public function delete(User $user, Request $request, EntityManagerInterface $em): Response
{
    if (!$this->isCsrfTokenValid('delete', $request->headers->get('X-CSRF-TOKEN'))) {
        throw $this->createAccessDeniedException();
    }

    $em->remove($user);
    $em->flush();

    return new Response(status: Response::HTTP_NO_CONTENT);
}
```

Le jeton n'est envoyé que si la protection CSRF est activée (`framework.csrf_protection`).

Si votre application avait son propre JavaScript sur ces liens (classe `.supprimer`), retirez-le pour éviter une double action.

## Ce qui change selon votre usage

### Filtres

| Avant | Après |
|---|---|
| La requête recevait les valeurs brutes du navigateur | Elle reçoit les valeurs du formulaire (entité pour `EntityType`, date pour `DateType`…) |
| Les champs vides pouvaient être présents | Ils sont absents : tester avec `isset()` |
| Libellés des champs non affichés par défaut | Ils sont affichés (`form_row`) ; passer `'label' => false` pour les masquer |
| Thème `form/my-form.html.twig` appliqué | Plus appliqué : surcharger le template des filtres |

### Tri, pagination, URL

- `EntityColumnType` n'est plus triable par défaut. Pour le réactiver, joindre la relation dans l'option `query`, puis passer `'order' => null` et `'order_by' => 'alias.champ'`.
- Le choix du nombre d'éléments par page n'apparaît que si `length_change` vaut `true`.
- Seules les tailles de `page_length` et `length_menu` sont acceptées.
- `setLoadUrl()` génère un chemin (`/users`) et ne force plus `https`. Derrière un proxy, configurer `trusted_proxies`.

### Templates surchargés

- `<th id="…">` devient `<th data-column="…">` (à vérifier aussi dans votre CSS et JavaScript).
- Repartir des nouveaux templates du bundle : `table.html.twig`, `filters.html.twig`, `toolbar/block_filters.html.twig`.
- `toolbar/theme.html.twig` est supprimé.

### Modales

Le bundle fournit son contrôleur. Pour garder le vôtre :

```php
$builder->add('edit', RowModalLinkType::class, [
    'route' => 'user_edit',
    'stimulus-controller' => 'modal',
]);
```

Avec le contrôleur du bundle, un formulaire invalide doit répondre en 422 (le comportement de `render()` quand on lui passe le formulaire).

### Classes étendues ou instanciées à la main

Les constructeurs de ces classes ont changé :

| Classe | Changement |
|---|---|
| `LinkType` et ses enfants | `$parameterBag` remplacé par `$icons`, ajout de `$actionToken` |
| `ButtonType`, `SelectChangeType` | ajout de `$actionToken` |
| `SelectColumnType` | ajout de `$router` et `$actionToken` |
| `TableRenderer` | ajout de `$translator` |

Les identifiants de services `da_table.*` n'existent plus, sauf `da_table.table_factory`. Injecter les classes ou `TableInterface`.

### Traductions

Les titres d'actions (`action.edit`, `action.delete`…) sont dans le domaine `da_table`. Pour les personnaliser, déplacer vos clés dans `translations/da_table.fr.yaml`.

## Dépréciations (à corriger quand vous voulez)

| Ancien | Nouveau |
|---|---|
| `fitlers_render()` | `filters_render()` |
| `$table->handleParamaters()` | `$table->handleParameters()` |

## Vérifier que tout fonctionne

```bash
php bin/console cache:clear
```

Puis, sur un tableau : affichage, tri, filtres, changement de page, modale et suppression. Surveiller la console du navigateur.

| Symptôme | Cause probable |
|---|---|
| Tableau vide, aucune requête | Contrôleur `table` non activé (étape 2) |
| Balises HTML visibles | Étape 4 |
| Erreur 405 à la suppression | Étape 5 |
| La modale ne s'ouvre pas | Contrôleur `modal` non activé (étape 2) |
