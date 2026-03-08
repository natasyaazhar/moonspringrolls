<!DOCTYPE html>
<html>

<head>
    <title>Popia Delivery Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6f8fb;
        }
        .card {
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .status-delivery {
            color: #0d6efd;
            font-weight: 600;
        }
        .status-sent {
            color: green;
            font-weight: 600;
        }
        .status-pending {
            color: orange;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>📦 Popia Delivery Monitor</h4>
                <div class="d-flex justify-content-end gap-2">
                    <form method="POST" action="/sync-parcel">
                        @csrf
                        <button class="btn btn-primary mr-10">
                            Sync Google Spreadsheet
                        </button>
                    </form>

                    <form method="POST" action="/send-ofd-email">
                        @csrf
                        <button class="btn btn-success">
                            Send OFD Emails
                        </button>
                    </form>
                </div>
            </div>


            <div class="card-body">
                
                @if(session('success'))
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div id="flash-message" class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!-- <th>Tracking</th> -->
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Email Notification</th>
                            <th>Send At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($parcels as $parcel)
                        <tr>
                            <!-- <td>{ $parcel->tracking_code }</td> -->
                            <td>{{ $parcel['name'] }}</td>
                            <td>{{ $parcel['email'] }}</td>
                            <td>
                                <span class="status-delivery">
                                    {{ $parcel['parcel_status'] }}
                                </span>
                            </td>
                            <td>
                                @if($parcel['updated_at'])
                                <span class="status-sent">
                                    ✔ Sent
                                </span>
                                @else
                                <span class="status-pending">
                                    Waiting
                                </span>
                                @endif
                            </td>
                            <td>
                                {{ $parcel['updated_at'] ? $parcel['updated_at'] : 'Not sent yet' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-message');
        if(flash){
            setTimeout(() => {
                flash.style.transition = "opacity 0.5s";
                flash.style.opacity = 0;
                setTimeout(() => flash.remove(), 500);
            }, 1000);
        }
    });
</script>
</html>