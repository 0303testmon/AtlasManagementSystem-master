@extends('layouts.sidebar')

@section('content')
    <div class="w-75" style="margin:10% auto auto auto">
        <div class="card">
            <div class="w-100 card-body">

                {{-- <div class="vh-100 pt-5" style="background:#ECF1F6;">
        <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
            <div class="w-75 m-auto border" style="border-radius:5px;"> --}}

                <p class="text-center" style="border-top:none">{{ $calendar->getTitle() }}</p>
                <div class="" style="border:0.05px solid #E7E7E7; border-top:none">
                    {!! $calendar->render() !!}
                    {{-- 0916 add --}}
                    {{-- <div class="adjust-table-btn m-auto text-right">
                        <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting"
                            onclick="return confirm('登録してよろしいですか？')"> --}}
                    {{-- 0916 add --}}

                    {{-- 0926 add --}}
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p></p>
                                    <p></p>
                                    <input type=hidden name="partId" value="" form="deleteParts">
                                    上記の予約をキャンセルしてもよろしいですか？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        閉じる
                                    </button>
                                    <input type="submit" class="btn btn-primary" value="キャンセル" form="deleteParts">
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        window.onload = function() {
                            $('#deleteModal').on('shown.bs.modal', function(event) {
                                var button = $(event.relatedTarget); //モーダルを呼び出すときに使われたボタンを取得
                                var date = button.data('date'); //data-date
                                var part = button.data('part'); //data-part
                                var id = button.data('id'); //data-id
                                var modal = $(this);

                                modal.find('.modal-body p').eq(0).text("予約日 : " + date);
                                modal.find('.modal-body p').eq(1).text("時間 : " + part);
                                modal.find('.modal-body input').eq(0).val(id);
                                //formタグのaction属性にurlのデータ渡す
                                // modal.find('form').attr('action',url);
                            });
                        }
                    </script>
                    {{-- 0926 add --}}
                    {{-- 1014 add --}}
                    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
                    </script> --}}
                    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
                        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
                    </script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
                        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
                    </script> --}}
                </div>
            </div>
            <div class="text-right w-75 m-auto">
                <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
            </div>
        </div>
    </div>
@endsection
