<ul data-brackets-id="12674" id="sortable" class="list-unstyled ui-sortable">
    @foreach($data as $review)
        <strong class="pull-left primary-font">{{$review->user->name}}</strong>
        <small class="pull-right text-muted">
           <span class="glyphicon glyphicon-time"></span>{{$review->created_at}}</small>
        </br>
        <li class="ui-state-default">{{$review->review}} </li>
        </br>
        @endforeach
</ul>