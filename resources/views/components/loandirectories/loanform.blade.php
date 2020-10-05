<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#loanFormModal">
    Request for a device or item
</button>

<!-- Modal -->
<div class="modal fade loanFormModal" id="loanFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group pr-1">
                        <label class="font-weight-bold">Name of staff</label>
                        <select class="form-control js-itemRequestedFor-single">
                            <option value="1">Derick Ruganuza</option>
                            <option value="2">Felister Massawe</option>
                            <option value="3">Daudi Kabalika</option>
                            <option value="3">John Msocha</option>
                        </select>
                    </div>

                    <div class="form-group pr-1">
                        <label class="font-weight-bold">Select Items Required</label>
                        <select multiple class="form-control js-requestedItems-multiple">
                            <option value="1">Laptop with Power Adapter</option>
                            <option value="2">Power Adapter for Laptop</option>
                            <option value="2">Laptop Bag</option>
                            <option value="2">Monitor</option>
                            <option value="2">Dock Station with Power Adapter</option>
                            <option value="2">Power Adapter for Dock Station</option>
                            <option value="3">Mouse</option>
                            <option value="3">Keyboard</option>
                            <option value="2">Desktop</option>
                            <option value="2">Projector</option>
                            <option value="2">Flash Disk</option>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit Request</button>
            </div>
        </div>
    </div>
</div>

