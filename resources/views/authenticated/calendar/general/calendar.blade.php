@extends('layouts.sidebar')

@section('content')
    <div class="vh-100 pt-5" style="background:#ECF1F6;">
        <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
            <div class="w-75 m-auto border" style="border-radius:5px;">

                <p class="text-center">{{ $calendar->getTitle() }}</p>
                <div class="">
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
                </div>
            </div>
            <div class="text-right w-75 m-auto">
                <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
            </div>
        </div>
    </div>
@endsection
