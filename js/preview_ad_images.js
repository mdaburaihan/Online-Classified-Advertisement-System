        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adimg1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adimg2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#adimg3').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }