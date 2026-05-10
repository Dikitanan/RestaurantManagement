<x-app-layout>
    <!-- Include the necessary meta tags and stylesheets from admincss -->
    @include("admin.admincss")

    <!-- Content Section -->
    <div class="container-scroller">  
        @include("admin.navbar")

        <div class="content-wrapper">
            <!-- Food Upload Form -->
            <div class="form-container">
                <form action="{{ url('/uploadfood') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title" style="color: white;">Title</label>
                        <input class="form-control" type="text" name="title" placeholder="Write a title" required>
                    </div>

                    <div class="form-group">
                        <label for="price" style="color: white;">Price</label>
                        <input class="form-control" type="number" name="price" placeholder="Price" required>
                    </div>

                    <div class="form-group">    
                        <label for="image" style="color: white;">Image</label>
                        <input class="form-control-file" type="file" name="image" required>
                    </div>

                    <div class="form-group">
                        <label for="description" style="color: white;">Description</label>
                        <input class="form-control" type="text" name="description" placeholder="Description" required>
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>

            <!-- Display Data Table -->
            <div class="table-container">
                <table class="table table-striped">
                    <thead>
                        <tr align="center">
                            <th style="color: white;">Food Name</th>
                            <th style="color: white;">Price</th>
                            <th style="color: white;">Description</th>
                            <th style="color: white;">Image</th>  
                            <th style="color: white;">Action</th>
                            <th style="color: white;">Action2</th>          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr align="center">
                                <td style="color: white;">{{ $item->title }}</td>
                                <td style="color: white;">{{ $item->price }}</td>
                                <td style="color: white;">{{ $item->description }}</td>
                                <td><img height="300" src="/foodimage/{{ $item->image }}" alt="Food Image"></td>
                                <td><a class="btn btn-danger" href="{{ url('/deletemenu', $item->id) }}">Delete</a></td>
                                <td><a class="btn btn-warning" href="{{ url('/updateview', $item->id) }}">Update</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include the necessary scripts from adminscript -->
    @include("admin.adminscript")
</x-app-layout>
