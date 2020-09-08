#include<stdio.h>
#include<stdlib.h>

struct tree{
	int key;
	struct tree *left;
	struct tree *right;
};

struct tree *root=NULL;
struct tree *create();
struct tree *parent(int key);
struct tree *predecessor(int key);
struct tree *successor(int key);
void insertNode(int key);
void deleteNode(int key);//only deletes leaves
int searchNode(int key);
void inorder(struct tree *n);
void preorder(struct tree *n);
void postorder(struct tree *n);

int main(){
	while(true){
	    int o=0;
	    printf("\nSelect One Option:\n1. Search Node\n2. Insert Node\n3. Delete Node\n4. Inorder\n5. Preorder\n6. Postorder\n7. Predecessor\n8. Successor\nEnter Your Choice: ");
	    scanf("%d",&o);
	    switch(o){
	        case 1://search
	                printf("\nSEARCH NODE: ");
	                int key;
	                scanf("%d",&key);
	                searchNode(key);
	            break;
	        case 2://insert
	                printf("\nINSERT NODE: ");
	                int key;
	                scanf("%d",&key);
	                insertNode(key);                
	            break;
	        case 3://delete
	                printf("\nDELETE NODE: ");
	                int key;
	                scanf("%d",&key);
	                deleteNode(key);                
	            break;
	        case 4://inorder
					printf("Inorder: ");
	                inorder(root);   
					printf("\n");
                break;
	        case 5://preorder
					printf("Preorder: ");
	                preorder(root);   
					printf("\n");
	            break;
			case 6://print
					printf("Postorder: ");
					postorder(root);
					printf("\n");
				break;
			case 7://predecessor
	                printf("\nPREDECESSOR OF: ");
	                int key;
	                scanf("%d",&key);
	                predecessor(key);
			    break;
	        case 8://successor
	                printf("\nSUCCESSOR OF: ");
	                int key;
	                scanf("%d",&key);
	                successor(key);
		        break;
	        default: printf("\n*********** Bye *************\n");
	            exit(0);
	            break;
	        } 
	}
return 0;
}

struct tree *create(){
	return (struct tree *)malloc(sizeof(struct tree));	
}
	
void insertNode(int key){
	if(root==NULL){
		struct tree *node;
		node=create();
		node->key=key;
		node->left=NULL;
		node->right=NULL;
		root=node;
	}else{
		struct tree *p,*node;
		p=parent(key);
		if(p!=NULL){
			node=create();
			node->key=key;
			node->left=NULL;
			node->right=NULL;
			if(p->key>key){
				p->left=node;
			}else if(p->key<key){
				p->right=node;
			}
		}
	}
}

struct tree *parent(int key){
	struct tree *temp=root,*parent;
	while(temp){
		if(temp->key>key){
			parent=temp;
			temp=temp->left;
		}else if(temp->key<key){
			parent=temp;
			temp=temp->right;
		}else{
			printf("\nNo Duplicate Nodes Allowed\n");	
			return NULL;
		}
	}
	return parent;
}
	
int searchNode(int key){
	struct tree *temp=root;
	while(temp){
		if(temp->key==key){
			printf("\nNode Found\n");
			return 1;
		}else if(temp->key>key){
			temp=temp->left;
		}else if(temp->key<key){
			temp=temp->right;
		}
	}
	printf("\nNode Not Present\n");
	return 0;
}
	
struct tree *predecessor(int key){
	struct tree *temp=root,*pred;
	while(temp){
		if(temp->key==key){
			printf("\nNode Found\n");
			if(temp->left!=NULL){
				temp=temp->left;
			while(temp){
				pred=temp;
				temp=temp->right;
			}
				printf("\nPredecessor: %d\n",pred->key);
				return pred;
			}
			break;
		}else if(temp->key>key){
			temp=temp->left;
		}else if(temp->key<key){
			temp=temp->right;
		}
	}
	printf("\nNo Predecessor Found\n");
	return NULL;
}

//NOTE: if no left node found, than its parent is ancestor if this is right child
struct tree *successor(int key){	
	struct tree *temp=root,*succ;
	while(temp){
		if(temp->key==key){
			printf("\nNode Found\n");
			if(temp->right!=NULL){
				temp=temp->right;
			while(temp){
				succ=temp;
				temp=temp->left;
			}
				printf("\nSuccessor: %d\n",succ->key);
				return succ;
			}
			break;
		}else if(temp->key>key){
			temp=temp->left;
		}else if(temp->key<key){
			temp=temp->right;
		}
	}
	printf("\nNo Succcessor Found\n");
	return NULL;
}

void deleteNode(int key){
	if(searchNode(key)){
		struct tree *temp=root,*parent;
		while(temp){
			if(temp->key==key){
				if(temp->left==NULL&&temp->right==NULL){
					free(temp);
					if(parent->key>key){
						parent->left=NULL;
					}else if(parent->key<key){
						parent->right=NULL;	
					}					
				}
				return;
			}else if(temp->key>key){
				parent=temp;
				temp=temp->left;
			}else if(temp->key<key){
				parent=temp;
				temp=temp->right;
			}
		}
	}
}
	
void inorder(struct tree *n){
	struct tree *temp=n;
	if(temp!=NULL){
		inorder(temp->left);
		printf("%d ",temp->key);
		inorder(temp->right);
	}
}
	
void preorder(struct tree *n){
	struct tree *temp=n;
	if(temp!=NULL){
		printf("%d ",temp->key);
		preorder(temp->left);
		preorder(temp->right);
	}
}
	
void postorder(struct tree *n){
	struct tree *temp=n;
	if(temp!=NULL){
		postorder(temp->left);
		postorder(temp->right);
		printf("%d ",temp->key);
	}
}