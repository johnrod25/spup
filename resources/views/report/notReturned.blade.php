@extends("layouts.app")
@section('content')
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="offset-md-3 col-md-6">
                    <h2 class="admin-heading text-center">Not Returned Items</h2>
                </div>
            </div>
            @if ($books)
                <div class="row">
                    <div class="col-md-12">
                        <table class="content-table">
                            <thead>
                                <th>No.</th>
                                <th>Faculty Name</th>
                                <th>Item</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date Issued</th>
                                <th>Return Date</th>
                                <th>No. of Days</th>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                @if($book->issue_status == 'N')
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->student->name }}</td>
                                        <td>{{ $book->book->name }}</td>
                                        <td>{{ $book->student->phone }}</td>
                                        <td>{{ $book->student->email }}</td>
                                        <td>{{ $book->issue_date->format('d M, Y') }}</td>
                                        <td>{{ $book->return_date->format('d M, Y') }}</td>
                                        <td><?php $date1 = date_create(date('Y-m-d'));
                                            $date2 = date_create($book->return_date->format('d-m-Y'));
                                            if($date1 < $date2){
                                              $diff = date_diff($date1,$date2);
                                              echo $days = $diff->format('%a days');
                                            }else{
                                              echo '0 days';
                                            } ?></td>
                                    </tr>
                                @endif
                                @empty
                                    <tr>
                                        <td colspan="10">No Record Found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
