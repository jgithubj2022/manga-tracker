
# Manga tracker Manga Bite App
#### "https://mangabite.page.gd"
### by Jiles Smith
---
<img width="500" height="300" alt="manga_bite_logo" src="https://github.com/user-attachments/assets/7b69f933-e63b-46be-ac55-7f15ad4a381b" />
graphic design by me as-well :)

Welcome to my constantly growing manga-user database tracker website, instructions and images below!
### Non-Functional Requirements
* The system should be able to handle multiple inputs and tables in the database
* The system should load and display manga listings within an acceptable response time for a small dataset.
* prepare statements when connecting to prevent sql injection
* friendly layout,with clear labeling, (inspired layout by my anime list in colorscheme and font)
* Sliding css applied view of manga for home view
* Background image of my chosen favorite manga (JJK)
* friendly gui with sidebar that scales to upper screen for mobile(haven't tested yet..)
  ### (UPDATE CONCEPTS FOR 0.3)
  ***
  ####  for confidentiality not presented in github but present on my live site demo :)!)
  ___
  * user favorites(user customization for backgrounds via their favorite)
  * friend system (accept, request, decline, friend dms)
  * messaging mechanism between users!
  * **BITE (live-demo present feature)**
      * manga bite is where if you are in another persons library, if you click bite and the selected manga is cloned to your personal manga library without the other users: description, rating, status,            and leaving the other parameters that the manga database sql takes in as null or empty. without insertion via '?'.

  

### Functional Requirements
* Store books I've read
* Upload images and descriptions for each manga
* Be able to view finished uploads of manga
* Search for names through database
* edit manga from the list, delete from list
(UPDATED AFTER 0.2)
* Search for usernames through database
* Settings
* Account management details
* Password hashing

---

  # How to run?
  * download Xampp and enable Apache and MySQL
  * direct yourself to c:/xamp/htcdocs and place my github repository for the manga-tracker, 
  * access http://localhost/phpmyadmin/ , and inisde of manga_tracker database paste the sql located in my sql folder.
  * Access http://localhost/manga_tracker/index.php to view the site and add or view Jiles' Anime List( want to add login so only I can add and anyone with link can view?)
  * to try commenting, and add features, create an account.
---

# Photos of my website and operations
***
## (NON-Logged in Homepage)
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/c18f25a8-fbc8-4ce9-84f9-48121901f530" />


## Login
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/7a32e613-87ed-47d1-82c5-10d743e50290" />



## Create Account
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/6a70d4a6-3e70-4e60-b9d6-d8c15580b81a" />


## Home of the Jiles Manga-Tracker (logged in as jiles so manga below are in jiles database)
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/7b0afa07-6cbe-44a3-adf1-e71338b0211b" />



## Edit Feature
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/c584c21a-3357-4fdc-a073-d959d7959d6b" />


## Comments (only removeable by poster of comment)
---
<img width="800" height="200" alt="image" src="https://github.com/user-attachments/assets/fa3faa87-82f5-4550-ba16-f1b0c4b3b953" />


## Settings
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/571e4bd9-5095-41a3-bef1-47d1b7bdf701" />


## Friends list
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/a50b4230-f1de-4de4-b56a-1efd54f63797" />


## Friends status in database
---
(yellow = pending, green= accepted, white = add friend)
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/4951b58e-fae9-4356-87ad-b4f44738f6c3" />

## DM's (live website-demo exclusive)
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/9eaa7594-1d1f-47de-a370-5acea8b060bb" />

## Bite (clone manga from other libraries into yours for simplicity and current reading status shortcut!)
---
<img width="800" height="400" alt="image" src="https://github.com/user-attachments/assets/c3b7bc48-e50e-4ff6-a0b6-766a007dab03" />





