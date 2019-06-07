{!! form_start($form) !!}
<div class="row">
    <div class="col-md-4">
        {!! form_row($form->agent_id) !!}
        {!!  form_row($form->nom) !!}
        {!!  form_row($form->prenom) !!}
        {!!  form_row($form->date_naiss) !!}
    </div>
    <div class="col-md-4">
        {!!  form_row($form->matricule) !!}
        {!!  form_row($form->lieu_naiss) !!}
        {!!  form_row($form->sexe) !!}
        {!!  form_row($form->nationnalite) !!}
    </div>
    <div class="col-md-4">
        {!!  form_row($form->tel) !!}
        {!! form_row($form->employeur) !!}
        {!! form_row($form->profession) !!}
        {!! form_row($form->ref_acte_mariage) !!}
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save mdi-24px"></i>  Enregistrer</button>
    <a href="{{ route('conjoint.index') }}" class="btn btn-secondary"><i class="mdi mdi-cancel mdi-24px"></i> Annuler</a>
</div>

{!! form_end($form) !!}