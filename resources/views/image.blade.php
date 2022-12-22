<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Uploading</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .image_container{
            height: 120px;
            width: 200px;
            border-radius: 6px;
            overflow: hidden;
            margin: 10px;
        }
        .image_container img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
        .image_container span{
            top: -8px;
            right: 8px;
            color: #f8f9fa;
            font-size: 28px;
            font-weight: normal;
            cursor: pointer;
        }
        .addIcon{
            background-color: #e6e6e6;
            font-size: 10px !important;
        }
    </style>
</head>
<body>
    <div class="container mt-3 w-100">
        <div class="card shadow-sm w-100">
            <div class="card-header d-flex justify-content-between">
                <h4>Image Uploading</h4>
                <form action="#" id="form" class="form" method="post">
                    <input type="file" name="Image" id="image" multiple="" class="d-none" onchange="image_select()">
                    <button class="btn btn-sm btn-primay" type="button" onclick="document.getElementById('image').click()" >Choose Images</button>
                </form>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-start" id="container">
                <div class="image_container d-flex justify-content-center position-relative">
                    <img src="addGif (2).gif" class="addIcon" alt="Image" onclick="document.getElementById('image').click()">
                </div>
            </div>
        </div>
    </div>


    <script>
        var images = [];
        var addIcon =  ``;
        function image_select(){
            var image = document.getElementById('image').files;

            for(i = 0; i < image.length; i++){
                if(check_duplicate(image[i].name))
                {
                    images.push({
                        "name"  : image[i].name,
                        "url"   : URL.createObjectURL(image[i]),
                        "file"  : image[i],
                    })
                }
                else{
                    alert(image[i].name + " is already added to the list");
                }
            }
            document.getElementById('form').reset();
            document.getElementById('container').innerHTML = image_show();
            
        }
        function image_show(){
            var image = "";
            images.forEach((i) => {
                image += `  <div class="image_container d-flex justify-content-center position-relative">
                                <img src="`+ i.url +`" alt="Image">
                                <span class="position-absolute" onclick="delete_image(`+ images.indexOf(i) +`)">&times;</span>
                            </div>`;
            });
            image += `<div class="image_container d-flex justify-content-center position-relative">
                                <img src="addGif (2).gif" class="addIcon" alt="Image" onclick="document.getElementById('image').click()">
                            </div>`;
            return image;
        }

        function delete_image(e){
            
                images.splice(e, 1);
                document.getElementById('container').innerHTML = image_show();
            
            // document.getElementById('container').innerHTML= addIcon;
        }

        function check_duplicate(name) 
        {
            var image = true;
            if(images.length > 0)
            {
                for(e = 0; e < images.length; e++) {
                    if(images[e].name == name){
                        image = false;
                        break;
                    }
                }
            }
            return image;
        }
    </script>
</body>
</html>