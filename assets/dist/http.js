// Requêtes des actions (data-xhr, modale, listes déroulantes). Même origine uniquement.
export async function send(url, { method = 'GET', body, headers = {}, token } = {}) {
    const target = new URL(url, window.location.href);
    if (target.origin !== window.location.origin) {
        throw new Error('Cross-origin action refused');
    }
    const requestHeaders = { 'X-Requested-With': 'XMLHttpRequest', ...headers };
    let requestBody = body;
    if (token) {
        requestHeaders['X-CSRF-TOKEN'] = token;
        requestBody ??= new URLSearchParams({ _token: token });
    }
    const verb = method.toUpperCase();

    return fetch(target, {
        method: verb,
        headers: requestHeaders,
        body: verb === 'GET' || verb === 'HEAD' ? undefined : requestBody,
    });
}
