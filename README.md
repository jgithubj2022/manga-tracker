
# Manga tracker "Manga Bite" App
#### live demo(must be connected to wifi): https://mangabite.page.gd
### by Jiles Smith
---

<img width="550" height="200" alt="manga_bite_logo" src="https://github.com/user-attachments/assets/1f0acdc4-357f-48fc-a66a-432c6007fbe0" />

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
  * Access http://localhost/manga_tracker/index.php to view the site
  * make an account or if you don't want to, you may use "demojiles, demopass" to try out features below.
---

# Photos of my website and operations
***
## (NON-Logged in Homepage)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/c11d65b5-d4fa-408c-a81b-2e9052800754" />



## Login
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/b54b9cc6-4a08-489b-8fa1-593dbe717a73" />




## Create Account
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/5fff2184-0f31-433a-bee1-3a1b7d288a1c" />



## Home of the Jiles Manga-Tracker (logged in as jiles so manga below are in jiles database)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/e93cfebb-10a5-4101-8506-8cac0649a8f6" />




## Edit Feature
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/7244ebf9-ec1c-4f64-9f5a-2ea04e58980d" />



## Comments (only removeable by poster of comment)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/5d8076ca-67d9-40be-83e5-e1774ada1b67" />



## Settings
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/f44ae0b5-c634-46ec-baa8-7b4bd4d69ad6" />



## Friends list
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/c3eec05d-9b85-4c19-b107-c6df19ee0e71" />


## Friends status in database
---
(yellow = pending, green= accepted, white = add friend)
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/db209601-8c41-4174-ad60-f9f2b56d1fca" />


## DM's (live website-demo exclusive)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/9eaa7594-1d1f-47de-a370-5acea8b060bb" />

## Bite (clone manga from other libraries into yours for simplicity and current reading status shortcut!)
---
<img width="900" height="500" alt="Screenshot 2025-12-26 140341" src="https://github.com/user-attachments/assets/d95f4eb6-11f4-42cb-93fd-ce4514146cff" />






