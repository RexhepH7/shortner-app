<html>
    <head>
        <title>Shortener Project</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

        <!-- Styles -->
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <section class="">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6 vh-100 bg-secondary" style="width:30%">
                    <img src="{{asset('assets/images/logo.svg')}}" style="width:200px; margin-top: 50; margin-left: 120;"/></a>
                </div>
                <div class="col-lg-6 vh-100 bg-white">
                    <div class="container mt-5">
                        <h2>URL Shortner</h2>
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                            <form method="post" action="{{ route('generate.shorten.link.post') }}">
                                @csrf
                                <div class="imput-group mb-3">
                                    <input type="text" name="link" class="form-control" placeholder="Paste the URL to be shortened">
                                    <div class="input-group-addon">
                                        <button class="btn btn-success" style="margin-top: 10;">Shorten URL</button>
                                    </div>
                                </div>
                                @error('link') <p class="m-0 p-0 text text-danger"> {{ $message }}</p> @enderror
                            </form>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Short Link</th>
                                    <th>Link</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($shortLinks as $row )
                                 <tr>
                                    <td>{{ $row->id }}</td>
                                    <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                                    <td>{{ $row->link }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('shortLink.destroy', $row->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </section>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
