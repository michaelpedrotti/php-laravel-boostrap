<?php

namespace App\Observers;

use App\Models\Users;

class UsersObserver {

	/**
	 * Antes de criar um novo registro no db
	 */
	public function creating(Users $model){
			
//		$data = $model->getHidden();
//			
//		if(!empty($data) && array_has($data, 'password_plain')) {

//			$mailable = app(\App\Mail\WelcomeMail::class)
//				->subject(__('Portal HSC'))
//				->with('password', $data['password_plain'])
//				->with('model', $model);
//
//			\Mail::to($model->email)->send($mailable);
//		}
	}
	
	/**
	 * Antes de salvar a model
	 */
	public function saving(Users $model){

		if(empty($model->id)){
			$model->password = bcrypt(str_shuffle(date('Ymd')));
		}
	}	


	public function saved(Users $model){

//		if(request('acl_id') | request('is_distribuitor') | request('is_reseller') | request('is_customer')) {
//
//			// Remove todas as permissões do usuário de acesso
//			UserAcls::query()
//				->where('user_id', $model->id)
//					->delete();
//
//			$idPerfil = request('perfil');
//
//			if(!empty($idPerfil)) {
//				switch ($idPerfil){
//					case 1:  // se é admin
//						UserAcls::create([
//							'user_id' => $model->id, 
//							'acl_id' => $idPerfil
//						]);	
//						break;
//					case 6: //se é operator
//						$idOperator = Acls::query()->where('UID', 'OPERATOR')->first()->id;
//						UserAcls::create([
//							'user_id' => $model->id, 
//							'acl_id' => $idOperator
//						]);
//						$operator = Operators::firstOrNew(
//							['user_id' => $model->id] 
//						);
//						$operator->is_primary_operator = request('is_primary_operator');
//						$operator->save();
//
//						break;	
//				}
//			}
//
//			// Adicionar permissão de Distribuidor
//			if(!empty(request('is_distribuitor'))) {
//				UserAcls::create([
//					'user_id' => $model->id, 
//					'acl_id' => Acls::query()->where('UID', 'DISTRIBUTOR')->first()->id
//				]);
//			}
//
//			if(!empty(request('is_reseller'))) {
//				UserAcls::create([
//					'user_id' => $model->id, 
//					'acl_id' => Acls::query()->where('UID', 'RESELLER')->first()->id
//				]);
//			}
//
//			if(!empty(request('is_customer'))) {
//				UserAcls::create([
//					'user_id' => $model->id, 
//					'acl_id' => Acls::query()->where('UID', 'CUSTUMER')->first()->id
//				]);
//			}
//		}
	}

	/**
	 * Antes de atualizar o registro no db
	 */
	public function updating(Users $model){

//		$data = $model->getHidden();
//			
//		if(!empty($data) && array_has($data, 'password_plain')) {
//
//			$mailable = app(\App\Mail\ResetPassMail::class)
//				->subject(__('Troca de senha'))
//				->with('password', $data['password_plain'])
//				->with('model', $model);
//
//			try {	
//				\Mail::to($model->email)->send($mailable);
//			} 
//			catch (\Exception $e) {
//				flash(__('Falha ao enviar o e-mail de boas vindas'), 'warning');
//			}
//		}
	}
}
