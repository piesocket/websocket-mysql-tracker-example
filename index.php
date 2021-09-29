<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MySQL Tracker</title>

  <!-- UIkit CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.4/dist/css/uikit.min.css" />

</head>
<body>
  <div class="uk-container uk-padding">
    <h2>Users</h2>
    <p>Tracking users table with WebSockets</p>
    <table  class="uk-table">
      <thead>  
        <tr>
          <th>User ID</th>
          <th>User Name</th>
        </tr>
      </thead>  
    <tbody>  
        <?php
        $connection = mysqli_connect(
            'localhost',
            'root',
            'greatness',
            'websocket-v3-prod-copy'
        );
        $users = mysqli_query($connection, 'SELECT * FROM users');
        while ($user = mysqli_fetch_assoc($users)) {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>  
    </table>
    </div>
    <script src="https://unpkg.com/piesocket-js@1"></script>
    <script>
      var piesocket = new PieSocket({
        clusterId: 'free3',
        apiKey: '3EdTQ8iFKAw4it2TZupNsLYr2sGo6AWsddTUHhOSjhShS6FQMwhPjxIsh3vS'
      });

      // Connect to a WebSocket channel
      var channel = piesocket.subscribe("my-channel"); 
      channel.on("open", ()=>{
        console.log("PieSocket Channel Connected!");
      });

      //Handle updates from the server
      channel.on('message', function(msg){
        var data = JSON.parse(msg.data);
        if(data.event == "new_user"){
          alert(JSON.stringify(data.data));
        }
      });
    </script>
</body>
</html>