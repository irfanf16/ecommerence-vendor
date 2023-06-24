@extends('vendor.layouts.master',['navItem'=>'Notifications'])
@section('title', 'Notification')
@section('content')

{{-- Notifications --}}

<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="notification-header">
                    <h2>List of Notifications</h2>
                </div>
            </div>
            <div class="notification-table">
                <div class="table-responsive">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th class="notification-icons">Icon</th>
                                <th>Notifcation Message</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <th class="notification-icons">View Detail</th>

                            </tr>
                        </thead>

                        <tbody>
                            {{-- @php
                                $collection = collect(['taylor', 'framework', 'laravel']);
                                // $value = $collection->get('name');
                                dd($collection);
                            @endphp
                            @foreach ($collection as $col)
                                <li>{{$col}}</li>
                                <br>
                            @endforeach
                            {{dd("ende")}} --}}

                            {{-- {{dd($data)}} --}}
                            {{-- @foreach($data as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                            </tr>
                            @endforeach --}}



                            @foreach ($notifications as $notification)
                                <tr>
                                    <td>
                                        <div class="order-icon">
                                            <img src="/assets/images/notification/{{$notification->icon}}.svg"/>
                                        </div>
                                    </td>
                                    <td>
                                        {{$notification->message }}
                                    </td>

                                    <td>
                                        {{ date('d-M-y : H:i', strtotime($notification->created_at))}}
                                    </td>
                                    <td>
                                        {{ date('d-M-y : H:i', strtotime($notification->updated_at))}}
                                    </td>
                                    <td class="text-center">
                                        <a href="/{{$notification->link}}" class="btn btn-primary btn-icon-only custom-order-veiw">
                                            <span class=""><i class="fa fa-eye"></i></span>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach

                            {{-- {!! $data->links() !!} --}}
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>


</div>
{{-- <div class="modal modal-danger fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal_5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title_6">This is way to dangerous</h5>
                <button type="button" class="close-danger-modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                <i class="fa fa-exclamation-circle fa-4x"></i>
                <h4 class="heading mt-4">Are you sure?</h4>
                <p>Do you really want to delete this record?<br> This process cannot be undone.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Probably not</button>
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Yes, Confirm</button>
            </div>
        </div>
    </div>
</div> --}}




@endsection
