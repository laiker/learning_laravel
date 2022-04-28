@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

   

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="reports-form">
                <form method="POST" action="/admin/reports/generateReport">
                    @csrf
                    <select required name="reportsList[]" multiple="multiple">
                        <option value="Post">Статьи</option>
                        <option value="News">Новости</option>
                        <option value="Tag">Тэги</option>
                        <option value="Comment">Комментарии</option>
                        <option value="User">Пользователи</option>
                    </select>
                    <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Сгенерировать отчет</button>
                </form>
            </div>
        </div>
    </div>
@endsection