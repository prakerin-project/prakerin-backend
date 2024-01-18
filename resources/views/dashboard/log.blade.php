@extends('layouts.index')
@section('title', 'Jenis Perusahaan')
@section('content')
    <div class="row">
        <div class="col d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1>Logs</h1>
            </div>

        </div>
        <table class="table table-bordered">
            <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
                <tr>
                    <th>Action</th>
                    <th>Activity</th>
                    <th>User</th>
                    <th>IP Address</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    @php
                        $type = '';
                        switch ($log->action) {
                            case 'UPDATE':
                                $type = 'warning';
                                break;
                            case 'INSERT':
                                $type = 'primary';
                                break;
                            case 'DELETE':
                                $type = 'danger';
                                break;
                            default:
                                $type = 'secondary';
                        }
                    @endphp
                    <tr idlog='{{ $log->id }}'>
                        <td>
                            <div class="rounded text-center p-1 text-bg-{{ $type }} bg-{{ $type }}">
                                {{ $log->action }}</div>
                        </td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->user }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false,
            order: [-1, 'desc']
        });
    </script>
@endsection
