<?php/**** Gerenciador de produtos | lliure 6.x** @vers�o 4.0* @Desenvolvedor Jeison Frasson <jomadee@lliure.com.br>* @Cooperador Rodrigo Dechen <mestri.rodrigo@gmail.com>* @entre em contato com o desenvolvedor <jomadee@lliure.com.br> http://www.lliure.com.br/* @licen�a http://opensource.org/licenses/gpl-license.php GNU Public License**/switch(isset($_GET['ac'])?$_GET['ac']: ''){case 'write':	require_once("../../etc/bdconf.php"); 	require_once("../../includes/functions.php"); 		$retorno = jf_form_actions('salvar', 'salvar-editar');			jf_update(PREFIXO.'produtos', $_POST, array('id' => $_GET['produto']));		$_SESSION['aviso'] = array('Produto alterado com sucesso!', 1);		switch ($retorno){		case 'salvar':			$retorno = '../../index.php?app=produtos&cat='.$_GET['cat'];		break;				case 'salvar-editar':			$retorno = '../../index.php?app=produtos&p=editproduto&produto='.$_GET['produto'];		break;	}		header('location: '.$retorno);break;default:	$id = $_GET['produto'];		$consulta = "select * from ".$llAppTable." where id like ".$id;	$query = mysql_query($consulta);	$dados = mysql_fetch_array($query);		extract($dados);		$endComun = $llAppHome."&p=editproduto&produto=".$id;	?>	<div class="boxCenter">		<form method="post" action="<?php echo $_ll['app']['pasta'].'editproduto.php?ac=write&amp;cat='.$idCat.'&amp;produto='.$_GET['produto']?>" class="form" id="formprod"  enctype="multipart/form-data">			<fieldset>				<div>					<label>Nome</label>					<input type="text" maxlength="50" value="<?php echo $nome?>" name="nome" />				</div>									<div>				<table>						<tr>						<td width="120px">							<label>Destaque</label>							<select name="destaque">								<option value="0">N�o</option>								<option value="1" <?php echo ($destaque == 1?'selected':'')?>>Sim</option>							</select>						</td>						<td width="120px">							<label>Status</label>							<select name="status">								<option  value="1">Ativo</option>								<option  value="0" <?php echo ($status == 0?'selected':'')?>>Desativado</option>							</select>						</td>					</tr>					</table>								</div>				<div>					<label>Descri��o do Produto</label>					<textarea class="editor"  name="descricao"><?php echo $descricao?></textarea>					<span class="ex">Descreve seu produto. <strong>Campo obrigatorio</strong></span>				</div>									</fieldset>									<fieldset>									<?php					$galeriaAPI['tabela'] = "produtos";									$galeriaAPI['ligacaoCampo'] = 'idProd';					$galeriaAPI['ligacaoId'] = $_GET['produto'];										$galeriaAPI['dir'] = "../uploads/produtos";										$galeriaAPI['capaCampo'] = "foto";					$galeriaAPI['capaFoto'] = (!empty($dados['foto'])?$dados['foto']:"");										require_once('api/fotos/index.php');					?>					</fieldset>							<div class="botoes">				<a class="link" href="<?php echo $backReal?>" title="voltar">Voltar</a>						<button type="submit" name="salvar" title="Salva e volta para lsitagem de produtos" class="confirm">Salvar</button>				<button  type="submit" name="salvar-editar" title="Salva e continua nesta mesma tela">Salvar e continuar editando</button>			</div>		</form>	</div>		<script type="text/javascript">		ajustaForm();				tinyMCE.init({			// General options			mode : "textareas",			theme : "lliure",			width: '100%',		});	</script>	<?phpbreak;}?>