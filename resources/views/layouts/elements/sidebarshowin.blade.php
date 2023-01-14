<nav id="sidebarMenu" class="bg-light sidebar">
    <div class="position-sticky pt-3">
        <div class="card">
            <h5 class="card-header">Thông tin công văn</h5>
            <div class="card-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        * Mã số công văn: {{ $dataDocumentin->label_number }}
                    </li>
                    <li class="nav-item">
                        * Nội dung công văn: {{ $dataDocumentin->title }}
                    </li>
                    <li class="nav-item">
                        * Người ký: {{ $dataDocumentin->signature }}
                    </li>
                    <li class="nav-item">
                        * Ngày ký: {{ $dataDocumentin->signature_date }}
                    </li>
                    @cannot('lanhdao')
                    
                    <li class="nav-item">
                        <span class="btn btn-warning">

                            * Bút phê: {{ $dataDocumentin->butphe ?? ''}}</span>

                    </li>
                    
                    
                    <li class="nav-item">
                        <span class="btn btn-warning">* Ngày đến hạn: {{ $dataDocumentin->ngaydenhan ?? ''}}</span>

                    </li>
                    
                    
                    <li class="nav-item">
                        <span class="btn btn-warning">* Người phụ trách: {{$nguoiphutrach->name ?? ''}}</span>
                    </li>
                    
                    @endcannot
                </ul>
                @if ($dataDocumentin->status!=3 && $dataDocumentin->nguoiphutrach==Auth::user()->id)
                <form action="{{ route('documentins.cvdaxuly', $dataDocumentin->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="3">
                    <button class="btn btn-danger col-md-12 " type="submit">Đánh đấu đã xử lý</button>
                </form>
                @endif


                @can('lanhdao')
                <form action="{{ route('documentins.lanhdaogiaoviec', $dataDocumentin->id)}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <label for="label">Bút phê</label>
                    <textarea name="butphe" id="" rows="5"
                        class="col-md-12 form-control">{{ $dataDocumentin->butphe}}</textarea>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12">
                            <label for="">Ngày đến hạn</label>
                        </div>
                        <div class="col-12">
                            <input type="date" name="ngaydenhan" id="iddate" value="{{ $dataDocumentin->ngaydenhan }}"
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
                            <option @if($dataDocumentin->status == 0) selected @endif value="0">Đã tiếp nhận</option>
                            <option @if($dataDocumentin->status == 1) selected @endif value="1">Đã giao việc</option>
                            <option @if($dataDocumentin->status == 2) selected @endif value="2">Đang xử lý</option>
                            <option @if($dataDocumentin->status == 3) selected @endif value="3">Đã xử lý</option>
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
        </div>

    </div>
</nav>