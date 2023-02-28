<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Bootstrap Bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>

<!-- Time Ago -->
<script src="{{ asset('lib/jquery-timeago/jquery.timeago.min.js') }}"></script>
<script>
    $('time.timeago').timeago();
</script>

<script>
    $('body').on('click','.follow',function() {
        let btn = $(this);
        let id = btn.attr('data-id');
        let follow = btn.attr('data-follow');
        if(id != '') {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/follow/'+id,
                type:'PUT',
                data:{follow},
                success:function(rs) {
                    if (rs.status == 200 ) {
                        if (rs.data == 1 ) {                            
                            btn.find('i').removeClass('fa-regular');
                            btn.find('i').addClass('fa-solid');
                            btn.attr('data-follow',0);
                        } else {                            
                            btn.find('i').removeClass('fa-solid');
                            btn.find('i').addClass('fa-regular');
                            btn.attr('data-follow',1);
                        }
                        toastr.success(rs.message);
                    } else {
                        toastr.danger(rs.message);
                    }
                }
            })
        }       
    });
    function search_comic(keyword) {
        let search_rs = $('.search_comic_result')
        if(keyword != '') {
            search_rs.addClass('show');
            search_rs.html('<p class="mb-0 justify-center" style="height:100px"><i class="fas fa-spinner fa-pulse"></i></p>');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/search',
                type: 'PUT',
                data: {keyword},
                success: function(rs) {
                    if(rs.status==200) {
                        search_rs.html(rs.data);
                    } else {
                        search_rs.removeClass('show');
                        toastr.danger(rs.message);
                    }
                }
            });
        } else {
            search_rs.removeClass('show');
        }
    }
    let time;
    $('body').on('input','#search_comic',function() {
        let keyword = $(this).val();
        clearTimeout(time);
        time = setTimeout(() => {
            search_comic(keyword);
        }, 2000);
    });
    $(document).mouseup(function(e) {
        let search = $(".search_comic_result");
        if (!search.is(e.target) && search.has(e.target).length === 0) {
            search.removeClass('show');
            $('#search_comic').val('');
        }
    });    
</script>