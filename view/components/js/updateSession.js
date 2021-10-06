function updateSession() {
    let domain = window.location.origin
    fetch(domain + '/api/user.php?op=updateLastConnection').then(response => response.json())
    .then(res => {
        if (res.title == 'logout')
            window.location = domain + '/api/user.php?op=logout'
    })
}

document.addEventListener("DOMContentLoaded", () => {
    setInterval(updateSession(), 60000)
});