# Picture This
## About this project
We were tasked to mimic Instagram. We had some minimum requirements that are listed below. We were free to
add extra if we had time and the energy to do so.

# Built with
* PHP
* HTML
* CSS
* Javascript Vanilla

# How to install
1. Clone the repository
```
$ git clone https://github.com/Cleanly1/picture-this.git
```
2. Navigate to the folder where you cloned the repository via the terminal
3. Add an uploads folder in the root of the repository
4. Start a local server with php:
```
php -S localhost:8000
```
without php MAMP?
5. Open up your favorite browser and enter localhost:8000 in the url
6. Enjoy!

# Required
- As a user I should be able to create an account.

- As a user I should be able to login.

- As a user I should be able to logout.

- As a user I should be able to edit my account email, password and biography.

- As a user I should be able to upload a profile avatar image.

- As a user I should be able to create new posts with image and description.

- As a user I should be able to edit my posts.

- As a user I should be able to delete my posts.

- As a user I should be able to like posts.

- As a user I should be able to remove likes from posts.


# Extra

- As a user I should be able to follow and unfollow other users.

- As a user I should be able to search for another user.

- As a user I should be able to view followers and people the user follows.

- As a user I should be able to comment on a post.

- As a user I should be able to delete a comment from a post.

# Code reviw

By: Camilla Kylmänen Sjörén

- functions.php:196 - Function is missing description
- functions.php:221-301 - Same as above
- autoload.php:23 - Unnecessary comment
- navbar.css:9 & usermessages.css:25: In desktop the viewport becomes higher than 100vh and you have to scroll down to see the whole logo. Maybe put height: 8vh; on the navbar and height: 92vh; (for example, mkae total 100vh) on the welcomeScreen div to make the whole logo visible from start?
- header.php:17 - If you get two error messages they end up next to each other like this: "You have to enter a username that is atleast five characters longYour password needs to be atleast 5 characters long". Can be solved with a foreach maybe?
- index.php:52 - I cannot see the posts I have uploaded. Remember adding the path to where the image is stored: src="<?php echo $post['post_image'] ?>" (unless this has to do with .gitignore?)
- profile.php:37 - Same as above
- Consider adding alt-texts to your images (web accessibility)
- delete.php:14 - I cannot find a way to delete another user's post (which makes sense :) ), is this if-statement necessary?
- I think it's a nice and cool page. Nice work!! :)

# Testers
* Viktor Sjöblom
* Noname

# Maker

[Cleanly1](https://github.com/Cleanly1)

# License
This project is licensed under the MIT License - see the LICENSE file for details

YRGO 2019
