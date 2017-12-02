<html>
  <body>
    <h1>Dashboard</h1>
    <button onclick="appendNewRow()">Add New</button>
    <button onclick="generateRandomTable()">Generate Random Table</button>
    <table style="width:100%">
      <tbody id="table-body">
        <tr>
          <th>Energy Consumption (kW)</th>
          <th>Date</th> 
        </tr>
        <tr>
          <td><input type="number"></td>
          <td><input type="date"></td>
          <td><button>delete</button></td>
        </tr>
      </tbody>
    </table>
      <button>Save</button>
      <button onclick="generateReport()">Generate Report</button>
    <script>
      const tableBody = document.getElementById('table-body')
      function appendNewRow(kw, date, isNew) {
        const newRow = document.createElement('tr')
        newRow.innerHTML = `
          <tr>
            <td><input class="new-kw" type="number" ${kw ? 'value=' + kw.toString() : ''}></td>
            <td><input class="new-date" type="date" ${date ? 'value=' + date.toString() : ''}></td> 
            <td><button>delete</button></td>
          </tr>
        `
        tableBody.append(newRow)
      }

      function resetTable() {
        tableBody.innerHTML = ""
      }

      function generateRandomTable() {
        resetTable()
        const date = new Date()
        let i = 0
        while (i++ < 10) {
          date.setMonth(date.getMonth() - 1) // decrease month by 1
          const randomDate = date.toISOString().split("T")[0] // '2017-12-12'
          const randomValue = Math.floor(Math.random()*(20000 - 800 + 1) + 800)
          appendNewRow(randomValue, randomDate, true)
        }
      }

      function generateReport() {
        const kwtsEls = document.getElementsByClassName('new-kw')
        const dateEls = document.getElementsByClassName('new-date')
        const kwts    = [].slice.call(kwtsEls).map(el => el.value)
        const dates   = [].slice.call(dateEls).map(el => el.value)
        const report  = []

        kwts.forEach((kwt, i) => {
          report.push([kwt, dates[i]])
        })

        const requestParams = {
          method: 'POST',
          headers: {
            accept: 'application/json',
            'Content-Type': 'application/json',
            token: localStorage.getItem('token')
          },
          body: JSON.stringify({ report })
        }

        fetch('http://localhost:8000/api/v1/reports/', requestParams)
        .then(res => res.blob())
        .then(showFile)

      }

      function showFile(blob) {
        // It is necessary to create a new blob object with mime-type explicitly set
        // otherwise only Chrome works like it should
        var newBlob = new Blob([blob], {type: "application/pdf"})
       
        // IE doesn't allow using a blob object directly as link href
        // instead it is necessary to use msSaveOrOpenBlob
        if (window.navigator && window.navigator.msSaveOrOpenBlob) {
          window.navigator.msSaveOrOpenBlob(newBlob);
          return;
        } 
       
        // For other browsers: 
        // Create a link pointing to the ObjectURL containing the blob.
        const data = window.URL.createObjectURL(newBlob);
        var link = document.createElement('a');
        link.href = data;
        link.download="file.pdf";
        link.click();
        setTimeout(function(){
          // For Firefox it is necessary to delay revoking the ObjectURL
          window.URL.revokeObjectURL(data), 100})
        }

      <?php
        if($just_logged_in) {
          echo "localStorage.setItem('token', '$jwt')";
        }
      ?>
    </script>
  </body>
</html>