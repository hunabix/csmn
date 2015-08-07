<!-- Formulario de fechas -->
<form id="fechas-form" name="fechas-form" class="fechas-form form panel-contenido" method="post" action="<?= cs_url; ?>/configuracion" >
    
    <div class="field">
        <label for="ciclo-esc">Ciclo Escolar actual</label>
        <div class="input-group">
            <select id="ciclo-esc-conf" name="ciclo-esc" class="form-control"  placeholder="dd/mm/aaaa" seleccionado="<?= $data['configuracion']['ciclo_esc']; ?>">
                <option id="ciclo-conf-op1" value="ENERO - MARZO">ENERO - MARZO</option>
                <option id="ciclo-conf-op2" value="ABRIL - JUNIO">ABRIL - JUNIO</option>
                <option id="ciclo-conf-op3" value="JULIO - SEPTIEMBRE">JULIO - SEPTIEMBRE</option>
                <option id="ciclo-conf-op4" value="OCTUBRE - DICIEMBRE">OCTUBRE - DICIEMBRE</option>
            </select>
            <span class="input-group-addon"><i class="fa fa-history"></i></span>
        </div>
    </div>
    
    <!-- Ciclo 1 -->
    <h3 class="ciclos-titulos">ENERO - MARZO</h3>
    <div class="field">
        <label for="inicio-ins-ciclo1">Inicio de inscripciones</label>
        <div class="input-group">
           <input name="inicio-ins-ciclo1" type="text" id="inicio-ins-ciclo1" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_ins_ene_mar'] ?>">
           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="ciclo-esc-ciclo1">Cierre de inscripciones</label>
        <div class="input-group">
            <input name="cierre_ins-ciclo1" type="text" id="cierre-ins-ciclo1" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['cierre_ins_ene_mar']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="inicio-cur-ciclo1">Inicio de cursos</label>
        <div class="input-group">
            <input name="inicio-cur-ciclo1" type="text" id="inicio-cur-ciclo1" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_cur_ene_mar']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    
    <!-- Ciclo 2 -->
    <h3 class="ciclos-titulos">ABRIL - JUNIO</h3>
    <div class="field">
        <label for="inicio-ins-ciclo2">Inicio de inscripciones</label>
        <div class="input-group">
           <input name="inicio-ins-ciclo2" type="text" id="inicio-ins-ciclo2" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_ins_abr_jun'] ?>">
           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="ciclo-esc-ciclo2">Cierre de inscripciones</label>
        <div class="input-group">
            <input name="cierre_ins-ciclo2" type="text" id="cierre-ins-ciclo2" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['cierre_ins_abr_jun']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="inicio-cur-ciclo2">Inicio de cursos</label>
        <div class="input-group">
            <input name="inicio-cur-ciclo2" type="text" id="inicio-cur-ciclo2" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_cur_abr_jun']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div> 
    
    <!-- Ciclo 3 -->
    <h3 class="ciclos-titulos">JULIO - SEPTIEMBRE</h3>
    <div class="field">
        <label for="inicio-ins-ciclo3">Inicio de inscripciones</label>
        <div class="input-group">
           <input name="inicio-ins-ciclo3" type="text" id="inicio-ins-ciclo3" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_ins_jul_sep'] ?>">
           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="ciclo-esc-ciclo1">Cierre de inscripciones</label>
        <div class="input-group">
            <input name="cierre_ins-ciclo3" type="text" id="cierre-ins-ciclo3" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['cierre_ins_jul_sep']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="inicio-cur-ciclo1">Inicio de cursos</label>
        <div class="input-group">
            <input name="inicio-cur-ciclo3" type="text" id="inicio-cur-ciclo3" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_cur_jul_sep']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>                      
   
    <!-- Ciclo 4 -->
    <h3 class="ciclos-titulos">OCTUBRE - DICIEMBRE</h3>
    <div class="field">
        <label for="inicio-ins-ciclo4">Inicio de inscripciones</label>
        <div class="input-group">
           <input name="inicio-ins-ciclo4" type="text" id="inicio-ins-ciclo4" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_ins_oct_dic'] ?>">
           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="ciclo-esc-ciclo4">Cierre de inscripciones</label>
        <div class="input-group">
            <input name="cierre_ins-ciclo4" type="text" id="cierre-ins-ciclo4" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['cierre_ins_oct_dic']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
    <div class="field">
        <label for="inicio-cur-ciclo4">Inicio de cursos</label>
        <div class="input-group">
            <input name="inicio-cur-ciclo4" type="text" id="inicio-cur-ciclo4" class="form-control"  placeholder="dd/mm/aaaa" value="<?= $data['configuracion']['inicio_cur_oct_dic']; ?>">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div> 
    
    <input type="hidden" name="formulario" value="fechas-form">

    <!-- Botón enviar mensaje -->
    <div class="finalizar-btn">  
        <button type="submit" name="actualizar" value="Finalizar" class="btn btn-primary btn-fill">
            <i class="fa fa-check"></i> Guardar cambios
        </button>
    </div>

</form>