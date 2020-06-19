<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | Vue.js | Axios Example</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <h1>Content management</h1>
    <div id='myapp'>
 
  <!-- Select All records -->
  <input type='button' @click='allRecords()' value='Select All users'>
  <br><br>

  <!-- Select record by ID -->
  <input type='text' v-model='userid' placeholder="Enter Userid between 1 - 24">
  <input type='button' @click='recordByID()' value='Select user by ID'>
  <br><br>

  <!-- List records -->
  <table border=1 width='80%' style='border-collapse: collapse;'>
    <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>City</th>
            <th>Job</th>
    </tr>

    <tr v-for='user in users'>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.country}}</td>
            <td>{{user.city}}</td>
            <td>{{user.job}}</td>
    </tr>
  </table>
 
</div>

    </br>

    <script>
 var app = new Vue({
  el: '#myapp',
  data: {
    users: "",
    userid: 0
  },
  methods: {
    allRecords: function(){

      axios.get('contacts2.php')
      .then(function (response) {
         app.users = response.data;
         console.log(app.users);
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    recordByID: function(){
      if(this.userid > 0){
 
        axios.get('contacts2.php', {
           params: {
             userid: this.userid
           }
        })
        .then(function (response) {
           app.users = response.data;
        })
        .catch(function (error) {
           console.log(error);
        });
      }
    }
  }
})
    </script>

</body>
</html>