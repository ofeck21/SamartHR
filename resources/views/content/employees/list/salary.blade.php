<li class="nav-item list-group-item">
    <a class="nav-link p-0 {{(request()->segment(3) == 'employee-salary')? 'active' : 'text-dark'}}" href="{{url('employee/'.request()->segment(2).'/employee-salary')}}">
      <i data-feather='user'></i> &nbsp;
      {{lang('Employees.Basic Salary')}}
    </a>
</li>

@foreach ($components as $item)
  <li class="nav-item list-group-item">
    <a class="nav-link {{(request()->segment(4) == $item->code)? 'active' : 'text-dark'}} p-0"  href="{{url('employee/'.request()->segment(2).'/salary-components/'.$item->code)}}">
      @if ($item->type == 'allowance')
        <i data-feather='plus-circle'></i> &nbsp;
      @else
        <i data-feather='minus-circle'></i> &nbsp;          
      @endif
      {{$item->name}}
    </a>
  </li>
@endforeach