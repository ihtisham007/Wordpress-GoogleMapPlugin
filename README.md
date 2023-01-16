# Installation on localhost

Increase upload file size in `php.ini`

![phpVersion](https://user-images.githubusercontent.com/28805723/212650938-83c2e989-5eb6-44f6-be5d-23925db65812.png)

 search `upload_max_filesize`

![search_UploadFileSize](https://user-images.githubusercontent.com/28805723/212611290-f52c9b44-144d-4018-b671-7e1214d19b04.png)

change `upload_max_filesize` `2MB` to `20MB` 

![changeTo20MB](https://user-images.githubusercontent.com/28805723/212611695-ebdddc23-046d-4e93-aee3-5d5253a85ce7.png)


### Now on theme Folder
  - copy code from `function.php` and paste it to inside theme `function.php`
  - copy `single-newsfeed.php` file to theme folder where you are working on
  
###  newsfeed folder 

- zip  `newsfeed` folder 
- upload `newsfeed.zip` in plugin upload section 
- activate plugin 

### short code

```
[newsfeed-map]
```
Insert the shortcode [newsfeed-map] in pages or posts wherever you desire to display it, particularly on the archive page.

Finally Installed and you can see top of dashboard option will appear `NewsFeed` and then can post anything




