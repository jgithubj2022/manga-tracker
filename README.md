
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
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/6a40efd6-5721-47a5-bec8-ead184329254" />




## Login
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/fb115ded-8492-4056-840c-27ce0680ac81" />





## Create Account
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/eae11b8c-d91f-4a83-938a-433e1b424245" />




## Home of the Jiles Manga-Tracker (logged in as jiles so manga below are in jiles database)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/58fbed39-f745-48dc-96f0-abf708a73a48" />





## Edit Feature
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/3931e6e3-683e-42e1-b07d-007bcca37eea" />




## Comments (only removeable by poster of comment)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/83851536-b818-4746-977f-187121b33a1c" />




## Settings
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/0e30d3f4-ebe8-42ff-9440-8e68b8d099ed" />





## Friends list
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/ae3b9478-015b-44a9-8300-5bdf506fc81e" />



## Friends status in database
---
(yellow = pending, green= accepted, white = add friend)
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/7080906c-3667-4741-8ba5-9be4fc034ec6" />



## DM's (live website-demo exclusive)
---
<img width="900" height="500" alt="image" src="https://github.com/user-attachments/assets/b55feae2-a743-4e50-adb2-6cfb83cbbc28" />


## Bite (clone manga from other libraries into yours for simplicity and current reading status shortcut!)
---

<img width="900" height="500" alt="Screenshot 2025-12-28 215938" src="https://github.com/user-attachments/assets/b2ea1813-1ea4-4b45-abfe-7fb7ab1ba7d4" />


