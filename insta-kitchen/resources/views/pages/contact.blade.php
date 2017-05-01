@extends('main')

@section('title')
    Contact
@endsection

@section('content')

        <div class="row">
             <div class="col-md-8 col-md-offset-2">
                  <h1>Contact us</h1>
                  <hr>
                  <p class="lead">Feel free to contact us</p>
              </div>   
        </div>
        
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                 <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-2 col-md-offset-1" for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-md-8">
                      <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 col-md-offset-1" for="subject" class="col-sm-2 control-label">Subject</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="subject" placeholder="Subject">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-md-2 col-md-offset-1" for="message" class="col-sm-2 control-label">Message</label>
                    <div class="col-md-8">
                         <textarea rows="7" class="form-control" id="message" placeholder="Message"></textarea>
                       </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-8">
                      <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                  </div>
                </form>
                 
            </div>
        </div>
            
           
@endsection