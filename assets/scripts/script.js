
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
                roseButton[1].classList.remove('hidden');
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
                roseButton[0].classList.remove('hidden');
            })
        }

    })
})
// }


const searchForm = document.querySelector('.searchUsers');
console.log(searchForm);

searchForm.addEventListener('submit', function(){

    event.preventDefault();

    const searchInput = searchForm.querySelector('input');

    const userList = document.querySelector('ul');

    var formData = new FormData(searchForm);
    console.log(searchInput.value);

    fetch('app/users/search.php?search=' + searchInput.value, {
        method: 'POST',
        body: formData
    }).then(function(response){
        return response.json();
    }).then(function(users){
        userList.innerHTML = `<li>${users}</li>`
    })

});
