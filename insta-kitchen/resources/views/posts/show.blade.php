@extends('main')

@section('title', 'View Post')

@section('content')


<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <div class="thumbnail">
        
        <!-- Post Section -->
        <div class="well">
          <span class="post-title">
          <small><i class="fa fa-star info" style="color:#ee8b2d;" aria-hidden="true"></i> 
              {{ number_format($rating, 1) }} / {{ $total_raters }}</small> 
               {{ $post->title }} </span> 
            <div class="pull-right">
              @if( $post->user_id == Auth::user()->id)
              {!! Html::linkRoute('posts.index','Go to all posts',  Auth::user()->id , ['class' => 'btn btn-default']) !!}
              {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary')) !!}
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post{{$post->id}}">
                 Delete </button>
              @include('modals.delete_post')
              @endif
            </div>
        </div>
      <img src="/images/posts/{{ $post->image }}" alt="{{ $post->title }}">
      <div class="">
        <div class="post-details"> 
          <p class="post-desc">{{ $post->description }}</p>
          
          
           <h5>Available:<span> {{ $post->quantity }} </span></h5>
           <h5>Price:<span> £{{ $post->price }} <span></h5>
           <h5>Category:<span>  {{ $post->category->name }} <span></h5>
           <h5>Tags:<span> 
             @foreach ($post->tags as $tag)
               <span class="label label-default">{{ $tag->name }}</span>
             @endforeach
           <span></h5>
        
        </div>    
        <div class="info pull-right">
            <p>Posted by <a href="#">{{ $post->user->name }} </a> on: {{ date('j M,  Y - h:ia', strtotime($post->created_at)) }}</p>
        </div>
        <br>
        <hr>
        </div><!-- end post section -->         
      <!--  add new comment section -->
        @include('comments.comment')
      <!-- / end new comment section -->
       
      <!-- comment section --> 
      
      <!-- / end comment section -->
      
      
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
// Starrr plugin
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#hearts').on('starrr:change', function(e, value){
    $('#count').html(value);
  });
  
  $('#hearts-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
    $("#rate-count").val($("#count-existing").text());
  });
});
</script>

@endsection