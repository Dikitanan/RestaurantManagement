<x-app-layout>
    <!-- You can include any additional content here if needed -->
</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chef Management</title>
    @include("admin.admincss")
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Add any additional stylesheets or scripts here -->
</head>

<body>

    <div class="container-scroller">
        @include("admin.navbar")

        <div class="container mt-4">

            <form action="{{ url('/uploadchef') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" required placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="speciality">Speciality</label>
                    <input class="form-control" type="text" name="speciality" required placeholder="Enter the speciality">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input class="form-control-file" type="file" name="image" required>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>

            <table class="table table-dark mt-4">
                <thead>
                    <tr>
                        <th>Chef Name</th>
                        <th>Speciality</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Action2</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->speciality }}</td>
                        <td><img height="150px" width="150px" src="/chefimage/{{ $data->image }}" alt="{{ $data->name }}"></td>
                        <td><a href="{{ url('/updatechef', $data->id) }}" class="btn btn-info">Update</a></td>
                        <td><a href="{{ url('/deletechef', $data->id) }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        @include("admin.adminscript")
    </div>  

</body>

</html>
