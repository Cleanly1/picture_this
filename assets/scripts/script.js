
// if (window.location.href.indexOf('post.php') > -1) {

const roseForms = document.querySelectorAll('.roses');


roseForms.forEach(function(roseForm){

    const roseButton = roseForm.querySelectorAll('button');

    roseForm.addEventListener('submit', function(){

        event.preventDefault();

        var formData = new FormData(roseForm);
        if (roseButton[0].className !== 'hidden') {

            fetch('app/posts/rose.php?rose=' + roseButton[0].value, {
                method: 'POST',
                body: formData
            }).then(function(response){
                return response.json();
            }).then(function(roses){
                roseForm.querySelector('p').textContent = roses;
                roseButton[0].classList.add('hidden');
                roseButton[0].classList.remove('rosebutton');
                roseButton[1].classList.remove('hidden');
                roseButton[1].classList.add('rosebutton');
            })

        }else if (roseButton[1].className !== 'hidden') {

            fetch('app/posts/removeRose.php?rose=' + roseButton[1].value, {
                method: 'POST',
                body: formData
            }).then(function(response){
                return response.json();
            }).then(function(roses){
                roseForm.querySelector('p').textContent = roses;
                roseButton[1].classList.add('hidden');
                roseButton[1].classList.remove('rosebutton');
                roseButton[0].classList.remove('hidden');
                roseButton[0].classList.add('rosebutton');
            })
        }

    })
})
// }

if (window.location.href.indexOf('search.php') > -1) {
    const searchForm = document.querySelector('.searchUsers');
    console.log(searchForm);

    searchForm.addEventListener('submit', function(){


        event.preventDefault();

        const searchInput = searchForm.querySelector('input');

        window.location.href + '?search=' + searchInput.value;

        const userList = document.querySelector('.userList');

        userList.innerHTML = '';

        var formData = new FormData(searchForm);

        if (searchInput.value === '') {
            const listItem = `<h1>You have to search for something</h1>`;
            userList.innerHTML += listItem;
        }else{



            fetch('app/users/search.php?search=' + searchInput.value, {
                method: 'POST',
                body: formData
            }).then(function(response){
                return response.json();
            }).then(function(users){
                users.forEach(function(user){
                    if (user['error'] === 404) {
                        const listItem = `<h1>We couldn't find any users</h1>`;
                        userList.innerHTML += listItem;
                    }else{
                        const listItem = `<li class="searchedProfiles"><a href="/profile.php?username=${user['username']}">
                        <img class="profileImageSearch" src="${user['avatar_image']}"><p>${user['username']}</p>
                        </a></li>`;
                        userList.innerHTML += listItem;
                    }
                })
                console.log(users)
            })
        }

    });
}
// unused code for test to have follow without page refresh
// const followForm = document.querySelector('.followForm');
//
// followForm.addEventListener('submit', function(){
//     event.preventDefault();
//
//     const followButton = followForm.querySelectorAll('button');
//
//     var formData = new FormData(followForm);
//
//
//     if (followButton[0].className !== 'hidden') {
//
//         fetch('app/users/follow.php?followed=' + followButton.value, {
//             method: 'POST',
//             body: formData
//         }).then(function(response){
//             return response.json();
//         }).then(function(followed){
//             if (!followed['response']) {
//                 // console.log(followed)
//             }else {
//                 console.log(followed)
//
//             }
//         })
//     }else if (followButton[1].className !== 'hidden') {
//         fetch('app/users/unfollow.php?followed=' + followButton.value, {
//             method: 'POST',
//             body: formData
//         }).then(function(response){
//             return response.json();
//         }).then(function(followed){
//             if (!followed['response']) {
//                 // console.log(followed)
//             }else {
//                 console.log(followed)
//
//             }
//         })
//     }
//
// })
