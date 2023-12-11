<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>
        Question <textarea name="" name="q" col="30" rows="3"></textarea><br>
        <span id="msg" style="color:red"></span>
        <div id="pollBlock">
        Option 1 <input type="text" name="op[]"<br>
        Option 2 <input type="text" name="op[]"<br>
        </div>
        <button type="submit">Create Poll</button>
        <button type="button" onclick="addMoreOp()">Add More Options</button>
    </form>

    <script>
        let c = 2;
function addMoreOp() {
  if (c == 10) {
    document.getElementById('msg').innerHTML = 'Error..Max is 10 Options';
  } else {
    ++c;
    let opString = "Option " + c + " <input type='text' name='op[]'><br>";
    document.getElementById('pollBlock').innerHTML += opString;
  }
}
    </script>
</body>
</html>