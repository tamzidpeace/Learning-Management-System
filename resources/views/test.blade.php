<form action="/test2">

    @for ($i = 0; $i < 5; $i++)
    <tr>
        
        <td>
            <div class="form-check">
                <input class="form-check-input big-checkbox" name="present[]"
                 type="checkbox" value="{{$i}}"
                    id="defaultCheck1">
            </div>
        </td>

    </tr>
    @endfor

    
    <button type="submit" class="btn btn-primary save">Submit</button>
</form>