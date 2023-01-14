<nav id="sidebarMenu" class="col-md-12 sidebar">
    <div class="mb-2">
        <ul class="list-group">
            <li class="list-group-item active">
            Thông tin công văn
          </li>
            <li class="list-group-item">
                * Mã số công văn: {{ $dataDocumentout->label_number }}
            </li>
            <li class="list-group-item">
                * Nội dung công văn: {{ $dataDocumentout->title }}
            </li>
            <li class="list-group-item">
                * Người ký: {{ $dataDocumentout->signature }}
            </li>
            <li class="list-group-item">
                * Ngày ký: {{ $dataDocumentout->signature_date }}
            </li>
            
            @cannot('lanhdao')
                    
            <li class="list-group-item">
                <span class="btn btn-warning">

                    * Bút phê: {{ $dataDocumentout->butphe ?? ''}}</span>

            </li>
            
            
            <li class="list-group-item">
                <span class="btn btn-warning">* Ngày đến hạn: {{ $dataDocumentout->ngaydenhan ?? ''}}</span>

            </li>
            
            
            <li class="list-group-item">
                <span class="btn btn-warning">* Người phụ trách: {{$nguoiphutrach->name ?? ''}}</span>
            </li>
            
            @endcannot
        </ul>
        
        @if ($dataDocumentout->status!=3 && $dataDocumentout->nguoiphutrach=Auth::user()->id)
                <form action="{{ route('documentouts.cvdidaxuly', $dataDocumentout->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="3">
                    <button class="btn btn-danger col-md-12 " type="submit">Đánh đấu đã xử lý</button>
                </form>
                @endif

        {{-- Lanh dao giao vie --}}
        @can('lanhdao')
                <form action="{{ route('documentins.lanhdaogiaoviec', $dataDocumentout->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <label for="label">Bút phê</label>
                    <textarea name="butphe" id="" rows="5"
                        class="col-md-12 form-control">{{ $dataDocumentout->butphe}}</textarea>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12">
                            <label for="">Ngày đến hạn</label>
                        </div>
                        <div class="col-12">
                            <input type="date" name="ngaydenhan" id="iddate" value="{{ $dataDocumentout->ngaydenhan }}"
                                placeholder="dd-mm-yyyy" class="form-control">
                        </div>
                        <div class="col-4">
                            <span id="" class="form-text">

                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-2">
                        <label for="">Người phụ trách</label>
                        <div class="col-md-12"><input type="text" placeholder="Người phụ trách"
                                class="form-control search" name="nguoiphutrach"
                                value="{{$nguoiphutrach->name ?? ''}}" /></div>
                        <div class="col-4">
                            <span class="form-text">

                            </span>
                        </div>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                          <label for="type" class="col-form-label">Trạng thái :</label>
                        </div>
                        <div class="col-12">
                          <select name="status" class="form-select">
                            <option @if($dataDocumentout->status == 0) selected @endif value="0">Đã tiếp nhận</option>
                            <option @if($dataDocumentout->status == 1) selected @endif value="1">Đã giao việc</option>
                            <option @if($dataDocumentout->status == 2) selected @endif value="2">Đang xử lý</option>
                            <option @if($dataDocumentout->status == 3) selected @endif value="3">Đã xử lý</option>
                          </select>
                        </div>
                        
                      </div>

                    <div class="border-bottom mb-2"></div>
                    <button type="submit" class="btn btn-primary">Giao việc</button>
                </form>
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
                </script>
                <script type="text/javascript">
                    var path = "{{ route('autocomplete') }}";
                        $('input.search').typeahead({
    
                        source:  function (str, process) 
                        {
                            return $.get(path, { str: str }, function (data) {
                                return process(data);
                            });  
                        }
                    });
                </script>
                @endcan
    </div>
    
</nav>