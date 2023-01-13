export function loadScript(url, onLoad = () => {}) {
    const script = document.createElement('script');

    script.type = 'text/javascript';
    script.src = url;
    script.onload = onLoad;

    document.querySelector('head').append(script);
}
