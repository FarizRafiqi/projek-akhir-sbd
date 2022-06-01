@can($editGate)
  <a href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}" class="btn btn-success btn-sm btn-edit"
    data-id="{{ $row->id }}">edit</a>
@endcan

@can($showGate)
  <a href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}"
    class="btn btn-primary btn-sm btn-detail">detail</a>
@endcan

@can($deleteGate)
  @if (($row->role_id !== 1 && $row->getTable() === 'users') || ($row->getTable() === 'roles' && $row->id !== 1) || !in_array($row->getTable(), ['users', 'roles']))
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST"
      class="d-inline-block form-delete">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
    </form>
  @endif
@endcan
