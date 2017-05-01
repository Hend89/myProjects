@extends('main')

@section('title', 'Notification')

@section('styelsheets')
<style type="text/css">
    
body{ margin-top:50px;}
.nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
.tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
.tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
.tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
.tab-pane .list-group input[type="checkbox"]{ margin-top: 2px; }
.tab-pane .list-group .glyphicon { margin-right:5px; }
.tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
a.list-group-item.read { color: #222;background-color: #F3F3F3; }
hr { margin-top: 5px;margin-bottom: 10px; }
.nav-pills>li>a {padding: 5px 10px;}

.ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
.ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
.ad a.url {color: #093;text-decoration: none;}

</style>
@endsection

@section('content')

<div class="container">
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a data-toggle="pill" href="#inbox"><span class="badge pull-right">
                        {{ \App\Notification::where(['user_to' => Auth::user()->id])->get()->count() }}
                        </span> Inbox </a>
                </li>
                <li><a data-toggle="pill" href="#sent">Sent</a></li>
                <li><a data-toggle="pill" href="#process">Under Process</a></li>
                <li><a data-toggle="pill" href="#history">Order History</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="inbox">
                    <div class="list-group">
                          <table class="table">
                                <tr>
                                   <th>From</th>
                                   <th>Post</th>
                                   <th>Message</th>
                                   <th>Date</th>
                                   <th></th>
                                </tr>
                        @foreach($notifications as $notification) 
                            @if ($notification->post()->first()->user_id == Auth::user()->id)
                                <tr>
                                    <td>{{ $notification->user()->first()->name }}</td>
                                    <td>{{ $notification->post()->first()->title }}</td>
                                    <td>{{ $notification->message }}</td>
                                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                                    <td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-order-status{{$notification->id}}">
                                     Replay
                                </button>
                                 @include('modals.edit_order_status')</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                     
                    </div>
                </div> 
            <!-- tab sent -->
          
            <!-- tab sent -->
            <div class="tab-pane fade" id="sent">
                    <div class="list-group">
                             <table class="table">
                                 <tr>
                                   <th>To</th>
                                   <th>Post</th>
                                   <th>Message</th>
                                   <th>Date</th>
                                   <th></th>
                                </tr>
                            @foreach($sents as $sent) 
                                @if ($sent->user->id  == Auth::user()->id)
                                    <tr>
                                    <td>{{ $sent->post()->first()->user->name }}</td>
                                    <td>{{ $sent->post()->first()->title }}</td>
                                    <td>{{ $sent->message }}</td>
                                    <td>{{ $sent->created_at->diffForHumans() }}</td>
                                    <td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-order-status{{$notification->id}}">
                                     Replay
                                    </button>
                                     @include('modals.edit_order_status')</td>
                                    </tr>
                                @endif
                            @endforeach
                            </table>
                            
                    </div>
                </div> 
            
            <!-- end tab process -->
             <div class="tab-pane fade" id="process">
                    <div class="list-group">
                             <table class="table">
                                 <tr>
                                   <th>From</th>
                                   <th>Post</th>
                                   <th>Message</th>
                                   <th>Last update</th>
                                   <th></th>
                                </tr>
                            @foreach($processes as $process) 
                                @if ($process->user_to  == Auth::user()->id)
                                    <tr>
                                    <td>{{ \App\User::select('name')->where('id' , $process->user_id)->value('name') }}</td>
                                    <td>{{ $process->post_id }}</td>
                                    <td>{{ $process->message }}</td>
                                    <td>{{ $process->created_at->diffForHumans() }}</td>
                                    <td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-order-status{{$notification->id}}">
                                     Update
                                    </button>
                                  </td>
                                    </tr>
                                @endif
                            @endforeach
                            </table>
                            
                    </div>
                </div> 
            
            <!-- end tab history -->
            
          <div class="tab-pane fade" id="history">
                    <div class="list-group">
                             <table class="table">
                                 <tr>
                                   <th>From</th>
                                   <th>Post</th>
                                   <th>Message</th>
                                   <th>Last update</th>
                                    <th>Status</th>
                                  
                                </tr>
                           
                                    <tr>
                                    <td>Salman </td>
                                    <td>Toffee Puding</td>
                                    <td>2 boxes to be delivered today</td>
                                    <td> 5 days ago</td>
                                    <td class="alert alert-success"> Completed</td>
                                    </tr>
                                    <tr>
                                    <td>Noura Faroug  </td>
                                    <td>Pasta</td>
                                    <td>a pot of pasta</td>
                                    <td> 8 days ago</td>
                                    <td class="alert alert-success"> Completed</td>
                                    </tr>
                                    <tr>
                                    <td>Noura Faroug </td>
                                    <td>Pasta</td>
                                    <td>a pot of pasta</td>
                                    <td> 20 days ago</td>
                                    <td class="alert alert-danger"> Rejected</td>
                                    </tr>
                             
                            </table>
                            
                    </div>
                </div> 
            
            <!-- end tab process -->
        </div>
    </div>
</div>

@stop