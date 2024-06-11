<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Signature</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <style>
        #signature-pad {
            border: 1px solid #000;
            width: 400px;
            height: 200px;
        }
    </style>
</head>
<body>
    <form id="form" method="POST" action="save_signature.php">
        <div id="signature-pad" class="signature-pad">
            <canvas width="400" height="200"></canvas>
        </div>
        <button type="button" id="clear">Clear</button>
        <button type="button" id="submit">Submit</button>
        <input type="hidden" name="signature" id="signature">
    </form>
    <script>
        var canvas = document.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas);

        $("#clear").click(function() {
            signaturePad.clear();
        });

        $("#submit").click(function(event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataUrl = signaturePad.toDataURL();
                $("#signature").val(dataUrl);
                $.ajax({
                    url: 'save_signature.php',
                    type: 'POST',
                    data: {signature: dataUrl},
                    success: function(response) {
                        alert("Signature saved successfully!");
                    },
                    error: function() {
                        alert("Failed to save signature.");
                    }
                });
            }
        });
    </script>
</body>
</html>
