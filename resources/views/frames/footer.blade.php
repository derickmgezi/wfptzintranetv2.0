
<footer>
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>

</div>

</div>

</div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="./js/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
{{HTML::script("js/holder.min.js")}}
<script src="./js/holder.min.js"></script>

<script src="./js/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="./js/ie10-viewport-bug-workaround.js"></script>

@if(Session::has('create_post') || Session::has('new_post_error') || Session::has('post_id') || Session::has('edit_post_error'))
<script>$('#add-post-modal').modal('show');</script>
@endif

@if(Session::has('read_post'))
<script>$('#read-post').modal('show');</script>
@endif

@if(Session::has('create_news_post') || Session::has('new_news_post_error') || Session::has('news_post_id') || Session::has('edit_news_post_error'))
<script>$('#add-news-modal').modal('show');</script>
@endif

@if(Session::has('read_news_post'))
<script>$('#read-news-modal').modal('show');</script>
@endif

</body>

</html>