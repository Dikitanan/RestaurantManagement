<x-app-layout>
    
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Appointment Management</title>
    @include("admin.admincss")
  </head>
  <body>
    <div class="container-scroller">
      @include("admin.navbar")

      <div class="container mt-5">
        <h2 class="text-center mb-4">Appointment Details</h2>

        <!-- Filter inputs -->
        <div>
            <!-- Select input for status -->
            <label for="statusFilter">Filter by Status:</label>
            <select style="background-color: white; color: black;" id="statusFilter" class="form-control">
                <option value="all" style="background-color: white; color: black;">All</option>
                <option value="pending" style="background-color: white; color: black;">Pending</option>
                <option value="accepted" style="background-color: white; color: black;">Accepted</option>
                <option value="denied" style="background-color: white; color: black;">Denied</option>
            </select>
        </div>


        <div>
          <!-- Text input for filtering -->
          <label type="hidden" for="textFilter"></label>
          <input type="hidden" id="textFilter" style="color: blue;">
        </div>

        <!-- Table for displaying data -->
        <div class="table-responsive">
          <table id="dataTable" class="table table-bordered">
            <!-- Table headers -->
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <!-- Table body -->
            <tbody>
              @foreach($data as $item)
                <tr style="background-color: #fff;">
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->phone }}</td>
                  <td>{{ $item->date }}</td>
                  <td>{{ $item->time }}</td>
                  <td>{{ $item->message }}</td>
                  <td>{{ $item->status }}</td>
                  <td>
                    <form method="POST" action="{{ route('reservations.accept', $item->id) }}" style="display:inline">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn btn-info">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('reservations.deny', $item->id) }}" style="display:inline">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn btn-danger">Deny</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      // JavaScript function for applying the filter
      function applyFilter() {
        var status = document.getElementById("statusFilter").value;
        var textFilter = document.getElementById("textFilter").value.toLowerCase();

        var rows = document.getElementById("dataTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        for (var i = 0; i < rows.length; i++) {
          var row = rows[i];
          var statusColumn = row.cells[6].textContent.toLowerCase();

          if ((status === 'all' || statusColumn === status) && (textFilter === '' || row.textContent.toLowerCase().includes(textFilter))) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        }
      }

      // Call the applyFilter function when the status or text filter changes
      document.getElementById("statusFilter").addEventListener("change", applyFilter);
      document.getElementById("textFilter").addEventListener("input", applyFilter);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @include("admin.adminscript")
  </body>
</html>
