<tr class="list-answers" id="{{ $answer->id }}">
    <td>{{ $answer->id }}</td>
    <td>{{ $answer->content }}</td>
    <td><i class="fa fa-{{ $answer->is_correct == config('answer.correct') ? 'check text-success' : 'times text-danger' }}"></i></td>
    <td>
        <a href="{{ route('admin.words.answers.edit', [$answer->word_id, $answer->id]) }}" class="btn btn-primary btn-sm btn-edit-answer"><i class="fa fa-pencil"></i> {{ trans('layout.actions.edit') }}</a>
        <button class="btn btn-danger btn-sm btn-delete-answer" data-id="{{ $answer->id }}"><i class="fa fa-trash-o"></i> {{ trans('layout.actions.delete') }}</button>
    </td>
</tr>