# manga-tracker
---
Manga tracker I am making as a personal project to store a private database on a localhost through xampp to input manga I've read with photo's of them and small descriptions!
---
### Non-Functional Requirements
* The system should be able to handle multiple things in the database
* The system should load and display manga listings within an acceptable response time for a small dataset.
* prepare statements when connecting to prevent sql injection
* friendly layout,with clear labeling, (inspired layout by my anime list in colorscheme and font)
  

### Functional Requirements
* Store books I've read
* Upload images and descriptions for each manga
* Be able to view finished uploads of manga
* Search for names through database
* edit manga from the list, delete from list

---

  # How to run?
  * download Xampp and enable Apache and MySQL
  * direct yourself to c:/xamp/htcdocs and place my github repository for the manga-tracker, 
  * access http://localhost/phpmyadmin/ , and inisde of manga_tracker database paste the sql located in my sql folder.
  * Access http://localhost/manga_tracker/index.php to view the site and add or view Jiles' Anime List( want to add login so only I can add and anyone with link can view?)
