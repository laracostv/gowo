<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>One File</title>
  </head>

  <body>
    <input type="file" onchange="previewFile(this);" />
    <div id="preview"></div>
    <script>
      function previewFile(input) {
        const [file] = input.files
        const preview = document.getElementById('preview')
        const reader = new FileReader()

        document.createElement('img').remove();

        reader.onload = e => {
          const img = document.createElement('img')
          img.src = e.target.result
          console.log(img.src)
          img.width = 200
          img.height = 200
          img.alt = 'file'

          preview.appendChild(img)
        }

        reader.readAsDataURL(file)
      }
    </script>
  </body>
</html>