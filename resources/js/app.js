import './bootstrap';

function setupAppHeight() {
    if(window.visualViewport) {
        window.visualViewport.addEventListener('resize', updateAppHeight);
        window.visualViewport.addEventListener('scroll', updateAppHeight);
        updateAppHeight();
    }
    function updateAppHeight() {
        if(window.visualViewport) {
            document.documentElement.style.setProperty('--app-height', `${window.visualViewport.height}px`);
        }
    }
}
setupAppHeight();
