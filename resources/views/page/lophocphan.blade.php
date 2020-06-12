@extends('page.master')
@section('content')
<div class="tab-content" style="min-height: 600px">
    <div class="row">
        @foreach($allLHP as $lhp)
        <div class="col-md-6">
            <div style="margin-bottom: 15px; background-color: #fff; padding: 10px;">
                <div class="card-title1 mt-2" style="display: flex;">
                    <div style="flex: 1">
                        <span style="font-size: 1.3em; line-height: 40px; color: #333;">
                            <i class="fa fa-cube" aria-hidden="true"></i> {{$lhp->hocphan->hp_id}} -
                            {{$lhp->hocphan->hp_ten}} - #{{$lhp->sttl}}
                        </span>
                    </div>
                    <div class="flex-basic: auto">
                        @if(count($lhp->nhomthuchanh) > 0)
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#yeucau{{$lhp->nhomthuchanh[0]->sttnhom}}">
                            Yêu cầu phần mềm
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="yeucau{{$lhp->nhomthuchanh[0]->sttnhom}}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST">
                                        {{-- action="{{route('canbo.yeucau')}}" --}}
                                        <div class="modal-body">
                                            <h4>[Yêu Cầu Phần Mềm] - #{{$lhp->nhomthuchanh[0]->sttnhom}}</h4>
                                            <hr />
                                            <label>Phần mềm:</label>
                                            @csrf
                                            <input type="hidden" value="{{$lhp->nhomthuchanh[0]->sttnhom}}"
                                                name="sttnhom" />
                                            <select class="form-control js-example-basic-multiple" name="pm[]"
                                                multiple="multiple" style="width: 100%;">
                                                @foreach ($allPM as $pm)
                                                <?php $check = false; ?>
                                                @foreach($lhp->nhomthuchanh[0]->yeucau as $yc)
                                                @if($yc->pm_id == $pm->pm_id)
                                                <?php $check = true; ?>
                                                @endif
                                                @endforeach
                                                <option value="{{$pm->pm_id}}" @if($check) selected @endif>
                                                    {{$pm->pm_ten}}
                                                </option>
                                                @endforeach
                                            </select>
                                            <small>Chọn thêm phần mềm và cập nhật...</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <button class="btn btn-success">Đăng ký</button>
                        @endif
                    </div>
                </div>
                <div class="tab-content"
                    style="padding: 5px 10px;margin-left: 30px; min-height: 100px; background: #e6e6e6;">
                    <h5>Phần mềm yêu cầu</h5>
                    @if(count($lhp->nhomthuchanh) > 0)
                    @foreach($lhp->nhomthuchanh[0]->yeucau as $yc)
                    <button class="btn btn-default">{{ $yc->phanmem->pm_ten }}</button>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection