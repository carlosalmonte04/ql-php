<div class="main-wrapper">
  <header class="header">
    <a href="#" class="header-link" onclick="handleLogOut()">log out</a>
  </header>
  <h1 class="page-title">Report Builder</h1>
  <div class="btns-container">
    <button onclick="appendNewRow()" class="success">Add New</button>
    <button onclick="generateRandomTable()" class="warning">Generate Random Table</button>
  </div>
  <table>
    <tbody id="table-body">
      <tr>
        <th>Energy Consumption (kW)</th>
        <th>Date</th> 
        <th></th>
      </tr>
      <tr id="input-0">
        <td><input class="kw-input" type="number" required></td>
        <td><input class="date-input" type="date" required></td>
        <td><button class="danger">delete</button></td>
      </tr>
    </tbody>
  </table>
  <div class="btns-container">
    <button onclick="generateReport()" class="warning">Generate Report</button>
  </div>
  <script>
    <?php
      if(isset($just_logged_in)) {
        echo "localStorage.setItem('token', '$jwt')";
      }
    ?>
    
    const tableBody = document.getElementById('table-body')
    
    const TableLabels = `
      <tr>
        <th>Energy Consumption (kW)</th>
        <th>Date</th> 
        <th></th>
      </tr>
    `

    function appendNewRow(id, kw, date, isNew) {
      const newRow = document.createElement('tr')
      newRow.id = `input-${id}`
      newRow.innerHTML = `
        <tr>
          <td><input class="new-kw" type="number" ${kw ? 'value=' + kw.toString() : ''}></td>
          <td><input class="new-date" type="date" ${date ? 'value=' + date.toString() : ''}></td> 
          <td><button class="danger" onclick="removeInput(${id})">delete</button></td>
        </tr>
      `
      tableBody.append(newRow)
    }

    function resetTable() {
      tableBody.innerHTML = `
        <tr>
          <th>Energy Consumption (kW)</th>
          <th>Date</th> 
          <th></th>
        </tr>
      `
    }

    function generateRandomTable() {
      resetTable()
      const date = new Date()
      let i = 1
      while (i++ <= 10) {
        date.setMonth(date.getMonth() - 1) // decrease month by 1
        const randomDate = date.toISOString().split("T")[0] // '2017-12-12'
        const randomValue = Math.floor(Math.random()*(20000 - 800 + 1) + 800)
        appendNewRow(i, randomValue, randomDate, true)
      }
    }

    function removeInput(id) {
      const input = document.getElementById(`input-${id}`)

      input.remove()
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

      fetch('https://python-report-pdf.herokuapp.com/api/v1/reports/', requestParams)
      .then(res => res.blob())
      .then(showFile)
    }

    function showFile(blob) {
      const newBlob = new Blob([blob], {type: "application/pdf"})

      if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(newBlob);
        return;
      } 
      const data = window.URL.createObjectURL(newBlob);
      var link = document.createElement('a');
      link.href = data;
      link.download="eConsumption Report.pdf";
      link.click();
      setTimeout(function(){
        window.URL.revokeObjectURL(data), 100})
      }

      function handleLogOut() {
        localStorage.removeItem('token')
        window.location.href = "/ql/?controller=sessions&action=create";
      }

      window.onload = function() {
        if(!localStorage.getItem('token')) {
          window.location.href = "?controller=sessions&action=create"
        }
        else {
          document.getElementsByTagName('body').style = "display: flex"
        }
      }
  </script>
</div>