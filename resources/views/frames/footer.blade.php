                        <footer>
                            <p class="float-right"><a href="#">Back to top</a></p>
                            <p>2018 &copy; World Food Programme <!-- <a href="#">Donate</a> &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms of Use</a> --></p>
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

        {{HTML::script("js/tether.min.js")}}

        {{HTML::script("js/bootstrap.min.js")}}

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        {{HTML::script("js/ie10-viewport-bug-workaround.js")}}
        
        <!-- Custom scripts for SB Admin template -->
        {{HTML::script("js/sb-admin.min.js")}}
        
        <!-- Enable Scrollspy -->
        <script>
            $(document).ready(function(){
                $('.scrollspy').scrollSpy();
            });
        </script>

        <!-- Enable Pop-overs everywhere -->
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>


        <script>
            /**
             * this workaround makes magic happen
             * thanks @harry: http://stackoverflow.com/questions/18111582/tinymce-4-links-plugin-modal-in-not-editable
             */
            $(document).on('focusin', function (e) {
                if ($(e.target).closest(".mce-window").length || $(e.target).closest(".moxman-window").length) {
                    e.stopImmediatePropagation();
                }
            });
        </script>

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

        @if(Session::has('add_update') || Session::has('create_update') || Session::has('new_update_error') || Session::has('update_id') || Session::has('edit_update_error'))
        <script>$('#add-update-modal').modal('show');</script>
        @endif

        @if(Session::has('read_update'))
        <script>$('#read-update-modal').modal('show');</script>
        @endif

        @if(Session::has('view_user_bio') || Session::has('add_user_bio'))
        <script>$('#user-bio-modal').modal('show');</script>
        @endif
        
        @if(Session::has('add_user') || Session::has('add_user_error') || Session::has('edit_user') || Session::has('edit_user_error'))
        <script>$('#addUserModal').modal('show');</script>
        @endif
        
        @if(Session::has('add_editor') || Session::has('add_editor_error') || Session::has('edit_editor') || Session::has('edit_editor_error'))
        <script>$('#addEditorModal').modal('show');</script>
        @endif
        
        @if(Session::has('create_story') || Session::has('new_story_error') || Session::has('edit_story') || Session::has('edit_story_error'))
        <script>$('#add-story-modal').modal('show');</script>
        @endif

    </body>

</html>