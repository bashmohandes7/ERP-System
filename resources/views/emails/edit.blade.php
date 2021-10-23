@extends('layouts.master')
@section('title', 'Emails')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Email</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                    <form method="post" action="{{route('email.update', $id)}}">
                        @csrf
                         <div class="row">
                          <div class="col-md-4"></div>
                            <div class="form-group col-md-4">
                                <lable>Approval</lable>
                                <select name="approve">
                                    <option value="0" @if($email->status==0)selected @endif>Pending</option>
                                    <option value="1" @if($email->status==1)selected @endif>Approve</option>
                                    <option value="2" @if($email->status==2)selected @endif>Reject</option>
                                    <option value="3" @if($email->status==3)selected @endif>Postponed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success" style="margin-top:40px">Update</button>
                          </div>
                        </div>
                      </form>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
