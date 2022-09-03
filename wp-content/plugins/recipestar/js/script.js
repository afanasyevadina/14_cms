document.querySelectorAll('.ratings i').forEach(i => {
    i.style.cursor = 'pointer'
    i.style.transition = '.3s'
    i.onclick = () => {
        i.style.opacity = '.5'
        i.style.cursor = 'default'
        fetch(`${window.adminUrl}?action=rate&recipe=${i.parentElement.dataset.id}&rate=${i.dataset.value}`)
            .then(response => response.text())
            .then(() => location.reload())
    }
})