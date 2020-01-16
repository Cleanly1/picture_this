
// if (window.location.href.indexOf('post.php') > -1) {

const roseForms = document.querySelectorAll('.roses');


roseForms.forEach(function(roseForm){

    const roseButton = roseForm.querySelectorAll('button');

    roseForm.addEventListener('submit', function(){

        event.preventDefault();

        var formData = new FormData(roseForm);
        if (roseButton[0].className !== 'hidden') {

            fetch('app/posts/rose.php', {
                method: 'POST',
                body: formData
            }).then(function(response){
                return response.json();
            }).then(function(roses){
                roseForm.querySelector('p').textContent = roses;
                roseButton[0].classList.add('hidden');
                roseButton[0].classList.remove('roseButton');
                roseButton[1].classList.remove('hidden');
                roseButton[1].classList.add('roseButton');
            })

        }else if (roseButton[1].className !== 'hidden') {

            fetch('app/posts/removeRose.php', {
                method: 'POST',
                body: formData
            }).then(function(response){
                return response.json();
            }).then(function(roses){
                roseForm.querySelector('p').textContent = roses;
                roseButton[1].classList.add('hidden');
                roseButton[1].classList.remove('roseButton');
                roseButton[0].classList.remove('hidden');
                roseButton[0].classList.add('roseButton');
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
// start on displaying image preview
// const createPostForm = document.querySelector('.createPost');
//
//
// createPostForm.addEventListener('change', function(){
//     console.log(event)
//
//     createPostForm.querySelector('img').src = event.target.value;
// })
