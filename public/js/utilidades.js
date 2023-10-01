function eliminar(event, id) {
    event.preventDefault();

    swal({
        title: '¿Estás seguro?',
        text: '¡No podrás deshacer esta acción!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        //if (result.isConfirmed) {
        // Si el usuario confirma, enviar el formulario de eliminación
        document.getElementById('eliminar-' + id).submit();
        //}
    });
}

function convertirPDFaBS64() {
    //Read File
    var selectedFile = document.getElementById("inputPdf").files;
    //Check File is not Empty
    if (selectedFile.length > 0) {
        // Select the very first file from list
        var fileToLoad = selectedFile[0];
        // FileReader function for read the file.
        var fileReader = new FileReader();
        var base64;
        // Onload of file read the file content
        fileReader.onload = function (fileLoadedEvent) {
            base64 = fileLoadedEvent.target.result;
            // Print data in console
            console.log(base64);
            var fileEnvio = document.getElementById("file");
            fileEnvio.value = base64;
        };
        // Convert data to base64
        fileReader.readAsDataURL(fileToLoad);
    }
}

function convertirImagenaBase64() {
    // Obtén el elemento de input de tipo file
    var inputImagen = document.getElementById('inputImagen'); // Reemplaza 'inputImagen' con el ID de tu input

    var archivo = inputImagen.files[0]; // Obtén el primer archivo seleccionado

    if (archivo) {
        var lector = new FileReader();

        lector.onload = function (e) {
            var imagen = new Image();

            imagen.onload = function () {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                canvas.width = imagen.width;
                canvas.height = imagen.height;
                ctx.drawImage(imagen, 0, 0);

                var base64String = canvas.toDataURL();

                console.log(base64String)
                var imageEnvio = document.getElementById("bookCover");
                imageEnvio.value = base64String;
                // La variable base64String ahora contiene la representación en base64 de la imagen, en el formato original.
            };

            imagen.src = e.target.result;
        }

        lector.readAsDataURL(archivo);
    }
}

function verDocumento(base64Url){ 
    var win = window.open(); 
    win.document.write("<iframe width='100%' height='100%' style='margin: 0; padding: 0' src=" + base64Url + "><\/iframe>");
}
