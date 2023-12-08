@props(['disabled' => false, 'options' => []])
<select multiple x-data="multiselect">
    
    <optgroup label="Names">
      <option value="1">John</option>
      <option value="2">Peter</option>
      <option value="3">Jane</option>
      <option value="4">Her Name is Very Long</option>
      <option value="5">His Name is Much Much Much Longer</option>
    </optgroup>
    <optgroup label="Cities">
      <option value="6">Prague</option>
      <option value="7">New York</option>
      <option value="8">Berlin</option>
      <option value="9">London</option>
      <option value="10">Los Angeles</option>
      <option value="11">Tokyo</option>
      <option value="12">Buenos Aires</option>
      <option value="13">Wien</option>
    </optgroup>
  </select>
